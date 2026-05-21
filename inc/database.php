<?php

declare(strict_types=1);

function ask_load_env(string $path): void
{
    static $loaded = false;

    if ($loaded) {
        return;
    }

    $loaded = true;

    if (!is_file($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = array_map('trim', explode('=', $line, 2));
        $value = trim($value, "\"'");

        if (getenv($key) === false) {
            putenv($key . '=' . $value);
        }

        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

function ask_env_value(string $key, string $default = ''): string
{
    $value = getenv($key);
    if ($value !== false && $value !== '') {
        return (string) $value;
    }

    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
        return (string) $_ENV[$key];
    }

    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
        return (string) $_SERVER[$key];
    }

    return $default;
}

ask_load_env(dirname(__DIR__) . '/.env');

function ask_db_config(): array
{
    return [
        'host' => ask_env_value('DB_HOST', 'localhost'),
        'port' => ask_env_value('DB_PORT', '3306'),
        'name' => ask_env_value('DB_NAME', 'ask_tutor'),
        'user' => ask_env_value('DB_USER', 'root'),
        'pass' => ask_env_value('DB_PASS', ''),
        'charset' => ask_env_value('DB_CHARSET', 'utf8mb4'),
    ];
}

function ask_db_connection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = ask_db_config();
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        $config['host'],
        $config['port'],
        $config['name'],
        $config['charset']
    );

    try {
        $pdo = new PDO($dsn, $config['user'], $config['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
        ]);
    } catch (PDOException $e) {
        throw new RuntimeException('No se pudo conectar a la base de datos: ' . $e->getMessage(), 0, $e);
    }

    return $pdo;
}

function ask_db_query_one(string $sql, array $params = []): ?array
{
    $stmt = ask_db_connection()->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch();
    return $row ?: null;
}

function ask_find_user_by_login(string $login): ?array
{
    return ask_db_query_one(
        'SELECT id, login, nombre, password_hash, rol, videos_generados, activo, created_at
         FROM usuarios
         WHERE login = :login AND activo = 1
         LIMIT 1',
        ['login' => $login]
    );
}

function ask_find_user_by_id(int $id): ?array
{
    return ask_db_query_one(
        'SELECT id, login, nombre, rol, videos_generados, activo, created_at
         FROM usuarios
         WHERE id = :id AND activo = 1
         LIMIT 1',
        ['id' => $id]
    );
}

function ask_update_user_name(int $id, string $nombre): bool
{
    $stmt = ask_db_connection()->prepare(
        'UPDATE usuarios SET nombre = :nombre WHERE id = :id AND activo = 1'
    );

    return $stmt->execute([
        'id' => $id,
        'nombre' => $nombre,
    ]);
}

function ask_update_user_name_by_login(string $login, string $nombre): bool
{
    $stmt = ask_db_connection()->prepare(
        'UPDATE usuarios SET nombre = :nombre WHERE login = :login AND activo = 1 AND rol = :rol'
    );

    return $stmt->execute([
        'login' => $login,
        'nombre' => $nombre,
        'rol' => 'docente',
    ]);
}

function ask_user_login_exists(string $login): bool
{
    $row = ask_db_query_one(
        'SELECT id FROM usuarios WHERE login = :login LIMIT 1',
        ['login' => $login]
    );

    return $row !== null;
}

function ask_create_docente(string $login, string $nombre, string $clave): int
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO usuarios (login, nombre, password_hash, rol, videos_generados, activo)
         VALUES (:login, :nombre, :hash, :rol, 0, 1)'
    );

    $stmt->execute([
        'login' => $login,
        'nombre' => $nombre,
        'hash' => password_hash($clave, PASSWORD_DEFAULT),
        'rol' => 'docente',
    ]);

    return (int) ask_db_connection()->lastInsertId();
}

function ask_get_course(string $slug): ?array
{
    return ask_db_query_one(
        'SELECT id, slug, titulo, descripcion, contenido, orden, activo
         FROM cursos
         WHERE slug = :slug AND activo = 1
         LIMIT 1',
        ['slug' => $slug]
    );
}

function ask_get_config(string $clave, string $default = ''): string
{
    $row = ask_db_query_one(
        'SELECT valor FROM configuracion WHERE clave = :clave LIMIT 1',
        ['clave' => $clave]
    );

    return $row !== null ? (string) $row['valor'] : $default;
}

function ask_set_config(string $clave, string $valor): void
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO configuracion (clave, valor)
         VALUES (:clave, :valor)
         ON DUPLICATE KEY UPDATE valor = VALUES(valor)'
    );

    $stmt->execute([
        'clave' => $clave,
        'valor' => $valor,
    ]);
}

function ask_increment_video_count(int $userId): void
{
    $stmt = ask_db_connection()->prepare(
        'UPDATE usuarios SET videos_generados = videos_generados + 1 WHERE id = :id AND activo = 1'
    );

    $stmt->execute(['id' => $userId]);
}
