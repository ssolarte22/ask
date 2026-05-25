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
         FROM tv_usuarios
         WHERE login = :login AND activo = 1
         LIMIT 1',
        ['login' => $login]
    );
}

function ask_find_user_by_id(int $id): ?array
{
    return ask_db_query_one(
        'SELECT id, login, nombre, rol, videos_generados, activo, created_at
         FROM tv_usuarios
         WHERE id = :id AND activo = 1
         LIMIT 1',
        ['id' => $id]
    );
}

function ask_update_user_name(int $id, string $nombre): bool
{
    $stmt = ask_db_connection()->prepare(
        'UPDATE tv_usuarios SET nombre = :nombre WHERE id = :id AND activo = 1'
    );

    return $stmt->execute([
        'id' => $id,
        'nombre' => $nombre,
    ]);
}

function ask_update_user_name_by_login(string $login, string $nombre): bool
{
    $stmt = ask_db_connection()->prepare(
        'UPDATE tv_usuarios SET nombre = :nombre WHERE login = :login AND activo = 1 AND rol = :rol'
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
        'SELECT id FROM tv_usuarios WHERE login = :login LIMIT 1',
        ['login' => $login]
    );

    return $row !== null;
}

function ask_create_docente(string $login, string $nombre, string $clave): int
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO tv_usuarios (login, nombre, password_hash, rol, videos_generados, activo)
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
         FROM tv_cursos
         WHERE slug = :slug AND activo = 1
         LIMIT 1',
        ['slug' => $slug]
    );
}

function ask_get_config(string $clave, string $default = ''): string
{
    $row = ask_db_query_one(
        'SELECT valor FROM tv_configuracion WHERE clave = :clave LIMIT 1',
        ['clave' => $clave]
    );

    return $row !== null ? (string) $row['valor'] : $default;
}

function ask_set_config(string $clave, string $valor): void
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO tv_configuracion (clave, valor)
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
        'UPDATE tv_usuarios SET videos_generados = videos_generados + 1 WHERE id = :id AND activo = 1'
    );

    $stmt->execute(['id' => $userId]);
}

function ask_list_docente_courses(int $docenteId): array
{
    $stmt = ask_db_connection()->prepare(
        'SELECT id, docente_id, nombre, descripcion, activo, created_at, updated_at
         FROM tv_docente_cursos
         WHERE docente_id = :docente_id AND activo = 1
         ORDER BY created_at DESC, id DESC'
    );
    $stmt->execute(['docente_id' => $docenteId]);

    return $stmt->fetchAll() ?: [];
}

function ask_create_docente_course(int $docenteId, string $nombre, string $descripcion = ''): int
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO tv_docente_cursos (docente_id, nombre, descripcion, activo)
         VALUES (:docente_id, :nombre, :descripcion, 1)'
    );

    $stmt->execute([
        'docente_id' => $docenteId,
        'nombre' => $nombre,
        'descripcion' => $descripcion,
    ]);

    return (int) ask_db_connection()->lastInsertId();
}

function ask_list_docente_topics(int $docenteId): array
{
    $stmt = ask_db_connection()->prepare(
        'SELECT t.id, t.docente_id, t.curso_id, t.nombre, t.descripcion, t.orden, t.activo, t.created_at, t.updated_at,
                c.nombre AS curso_nombre
         FROM tv_docente_temas t
         INNER JOIN tv_docente_cursos c ON c.id = t.curso_id
         WHERE t.docente_id = :docente_id AND t.activo = 1 AND c.activo = 1
         ORDER BY c.nombre ASC, t.orden ASC, t.id DESC'
    );
    $stmt->execute(['docente_id' => $docenteId]);

    return $stmt->fetchAll() ?: [];
}

function ask_list_docente_topics_by_course(int $docenteId, int $cursoId): array
{
    $stmt = ask_db_connection()->prepare(
        'SELECT id, docente_id, curso_id, nombre, descripcion, orden, activo, created_at, updated_at
         FROM tv_docente_temas
         WHERE docente_id = :docente_id AND curso_id = :curso_id AND activo = 1
         ORDER BY orden ASC, id ASC'
    );
    $stmt->execute([
        'docente_id' => $docenteId,
        'curso_id' => $cursoId,
    ]);

    return $stmt->fetchAll() ?: [];
}

function ask_create_docente_topic(int $docenteId, int $cursoId, string $nombre, string $descripcion = '', int $orden = 1): int
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO tv_docente_temas (docente_id, curso_id, nombre, descripcion, orden, activo)
         VALUES (:docente_id, :curso_id, :nombre, :descripcion, :orden, 1)'
    );

    $stmt->execute([
        'docente_id' => $docenteId,
        'curso_id' => $cursoId,
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'orden' => $orden,
    ]);

    return (int) ask_db_connection()->lastInsertId();
}

function ask_find_docente_course_by_id(int $cursoId, int $docenteId): ?array
{
    return ask_db_query_one(
        'SELECT id, docente_id, nombre, descripcion, activo
         FROM tv_docente_cursos
         WHERE id = :id AND docente_id = :docente_id AND activo = 1
         LIMIT 1',
        ['id' => $cursoId, 'docente_id' => $docenteId]
    );
}

function ask_list_docente_students(int $docenteId): array
{
    $stmt = ask_db_connection()->prepare(
        'SELECT id, docente_id, nombre, cedula, activo, created_at, updated_at
         FROM tv_docente_alumnos
         WHERE docente_id = :docente_id AND activo = 1
         ORDER BY created_at DESC, id DESC'
    );
    $stmt->execute(['docente_id' => $docenteId]);

    return $stmt->fetchAll() ?: [];
}

function ask_create_docente_student(int $docenteId, string $nombre, string $cedula): int
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO tv_docente_alumnos (docente_id, nombre, cedula, activo)
         VALUES (:docente_id, :nombre, :cedula, 1)'
    );

    $stmt->execute([
        'docente_id' => $docenteId,
        'nombre' => $nombre,
        'cedula' => $cedula,
    ]);

    return (int) ask_db_connection()->lastInsertId();
}

function ask_find_docente_student_by_id(int $alumnoId, int $docenteId): ?array
{
    return ask_db_query_one(
        'SELECT id, docente_id, nombre, cedula, activo, created_at, updated_at
         FROM tv_docente_alumnos
         WHERE id = :id AND docente_id = :docente_id AND activo = 1
         LIMIT 1',
        ['id' => $alumnoId, 'docente_id' => $docenteId]
    );
}

function ask_list_docente_course_students(int $docenteId): array
{
    $stmt = ask_db_connection()->prepare(
        'SELECT rel.id, rel.docente_id, rel.curso_id, rel.alumno_id, rel.activo, rel.created_at,
                c.nombre AS curso_nombre,
                a.nombre AS alumno_nombre,
                a.cedula AS alumno_cedula
         FROM tv_docente_curso_alumnos rel
         INNER JOIN tv_docente_cursos c ON c.id = rel.curso_id
         INNER JOIN tv_docente_alumnos a ON a.id = rel.alumno_id
         WHERE rel.docente_id = :docente_id AND rel.activo = 1
         ORDER BY rel.created_at DESC, rel.id DESC'
    );
    $stmt->execute(['docente_id' => $docenteId]);

    return $stmt->fetchAll() ?: [];
}

function ask_list_docente_course_students_by_course(int $docenteId, int $cursoId): array
{
    $stmt = ask_db_connection()->prepare(
        'SELECT rel.id, rel.docente_id, rel.curso_id, rel.alumno_id, rel.activo, rel.created_at,
                a.nombre AS alumno_nombre,
                a.cedula AS alumno_cedula
         FROM tv_docente_curso_alumnos rel
         INNER JOIN tv_docente_alumnos a ON a.id = rel.alumno_id
         WHERE rel.docente_id = :docente_id AND rel.curso_id = :curso_id AND rel.activo = 1
         ORDER BY rel.created_at DESC, rel.id DESC'
    );
    $stmt->execute([
        'docente_id' => $docenteId,
        'curso_id' => $cursoId,
    ]);

    return $stmt->fetchAll() ?: [];
}

function ask_unassign_docente_student_from_course(int $docenteId, int $cursoId, int $alumnoId): bool
{
    $stmt = ask_db_connection()->prepare(
        'DELETE FROM tv_docente_curso_alumnos
         WHERE docente_id = :docente_id AND curso_id = :curso_id AND alumno_id = :alumno_id'
    );

    return $stmt->execute([
        'docente_id' => $docenteId,
        'curso_id' => $cursoId,
        'alumno_id' => $alumnoId,
    ]);
}

function ask_assign_docente_student_to_course(int $docenteId, int $cursoId, int $alumnoId): int
{
    $stmt = ask_db_connection()->prepare(
        'INSERT INTO tv_docente_curso_alumnos (docente_id, curso_id, alumno_id, activo)
         VALUES (:docente_id, :curso_id, :alumno_id, 1)
         ON DUPLICATE KEY UPDATE activo = VALUES(activo)'
    );

    $stmt->execute([
        'docente_id' => $docenteId,
        'curso_id' => $cursoId,
        'alumno_id' => $alumnoId,
    ]);

    return (int) ask_db_connection()->lastInsertId();
}

function ask_list_admin_docente_table_rows(): array
{
     $stmt = ask_db_connection()->query(
          'SELECT
                u.id AS docente_id,
                u.nombre AS docente_nombre,
                u.login AS docente_login,
                a.id AS alumno_id,
                a.nombre AS alumno_nombre,
                a.cedula AS alumno_cedula,
                GROUP_CONCAT(DISTINCT c.nombre ORDER BY c.nombre SEPARATOR ", ") AS cursos
            FROM tv_usuarios u
            LEFT JOIN tv_docente_alumnos a
                ON a.docente_id = u.id AND a.activo = 1
            LEFT JOIN tv_docente_curso_alumnos rel
                ON rel.docente_id = u.id AND rel.alumno_id = a.id AND rel.activo = 1
            LEFT JOIN tv_docente_cursos c
                ON c.id = rel.curso_id AND c.activo = 1
            WHERE u.rol = "docente" AND u.activo = 1
            GROUP BY u.id, u.nombre, u.login, a.id, a.nombre, a.cedula
            ORDER BY u.nombre ASC, a.nombre ASC'
     );

     return $stmt->fetchAll() ?: [];
}
