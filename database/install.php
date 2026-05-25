<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/inc/database.php';

$schema = file_get_contents(__DIR__ . '/schema.sql');
if ($schema === false) {
    fwrite(STDERR, "No se pudo leer schema.sql\n");
    exit(1);
}

$config = ask_db_config();
$pdo = new PDO(
    sprintf('mysql:host=%s;port=%s;charset=%s', $config['host'], $config['port'], $config['charset']),
    $config['user'],
    $config['pass'],
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);

foreach (array_filter(array_map('trim', explode(';', $schema))) as $sql) {
    if ($sql !== '') {
        $pdo->exec($sql);
    }
}

$pdo->exec('CREATE OR REPLACE VIEW vw_docente_curso_alumnos_detalle AS
SELECT
    rel.id,
    rel.docente_id,
    u.nombre AS docente_nombre,
    u.login AS docente_login,
    rel.curso_id,
    c.nombre AS curso_nombre,
    rel.alumno_id,
    a.nombre AS alumno_nombre,
    a.cedula AS alumno_cedula,
    rel.activo,
    rel.created_at,
    rel.updated_at
FROM tv_docente_curso_alumnos rel
INNER JOIN tv_usuarios u ON u.id = rel.docente_id
INNER JOIN tv_docente_cursos c ON c.id = rel.curso_id
INNER JOIN tv_docente_alumnos a ON a.id = rel.alumno_id');

$pdo = ask_db_connection();

$pdo->exec('DROP TABLE IF EXISTS progreso_docente');
$pdo->exec("DELETE FROM tv_configuracion WHERE clave IN ('limite_videos_dia', 'duracion_maxima')");

$seed = file_get_contents(__DIR__ . '/seed.sql');
if ($seed !== false) {
    foreach (array_filter(array_map('trim', explode(';', $seed))) as $sql) {
        if ($sql !== '' && !str_starts_with($sql, '--')) {
            $pdo->exec($sql);
        }
    }
}

$usuarios = [
    ['login' => 'admin_tutor', 'nombre' => 'Administrador Tutor', 'clave' => 'Admin@2026', 'rol' => 'admin'],
    ['login' => 'maria.gomez', 'nombre' => 'María Gómez', 'clave' => 'Docente@123', 'rol' => 'docente'],
    ['login' => 'jose.perez', 'nombre' => 'José Pérez', 'clave' => 'Clase@456', 'rol' => 'docente'],
    ['login' => 'ana.lopez', 'nombre' => 'Ana López', 'clave' => 'Prompts@789', 'rol' => 'docente'],
    ['login' => 'carlos.ramirez', 'nombre' => 'Carlos Ramírez', 'clave' => 'Tutor@321', 'rol' => 'docente'],
];

$stmt = $pdo->prepare(
    'INSERT INTO tv_usuarios (login, nombre, password_hash, rol, videos_generados)
     VALUES (:login, :nombre, :hash, :rol, 0)
     ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), password_hash = VALUES(password_hash), rol = VALUES(rol)'
);

foreach ($usuarios as $usuario) {
    $stmt->execute([
        'login' => $usuario['login'],
        'nombre' => $usuario['nombre'],
        'hash' => password_hash($usuario['clave'], PASSWORD_DEFAULT),
        'rol' => $usuario['rol'],
    ]);
}


echo "Instalación completada.\n";
echo "Docente: maria.gomez / Docente@123\n";
echo "Docente alterno: carlos.ramirez / Tutor@321\n";
echo "Administrador: admin_tutor / Admin@2026\n";