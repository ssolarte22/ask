<?php

declare(strict_types=1);

/**
 * Instalador: crea tablas y datos iniciales con contraseñas hasheadas.
 * Ejecutar: php database/install.php
 */

require_once dirname(__DIR__) . '/bootstrap.php';

use App\Config\Database;
use App\Models\Configuracion;

$schema = file_get_contents(__DIR__ . '/schema.sql');
if ($schema === false) {
    fwrite(STDERR, "No se pudo leer schema.sql\n");
    exit(1);
}

// Conectar sin DB para crear la base
$host = App\Utils\Env::get('DB_HOST', '127.0.0.1');
$port = App\Utils\Env::get('DB_PORT', '3306');
$user = App\Utils\Env::get('DB_USER', 'root');
$pass = App\Utils\Env::get('DB_PASS', '');

$pdo = new PDO("mysql:host={$host};port={$port};charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

foreach (array_filter(array_map('trim', explode(';', $schema))) as $sql) {
    if ($sql !== '') {
        $pdo->exec($sql);
    }
}

$db = Database::connection();

$passwords = [
    'admin' => 'admin123',
    '123' => 'admin',
    'ela' => '45',
    '2343rbhg' => 'yy',
];

$stmt = $db->prepare(
    'INSERT INTO usuarios (login, nombre, password_hash, rol, videos_generados)
     VALUES (:login, :nombre, :hash, :rol, 0)
     ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), password_hash = VALUES(password_hash)'
);

$usuarios = [
    ['admin', 'Administrador', 'admin'],
    ['123', 'Lalo cota', 'docente'],
    ['ela', 'Elsa Pito', 'docente'],
    ['2343rbhg', 'gbhnhntyhty', 'docente'],
];

foreach ($usuarios as [$login, $nombre, $rol]) {
    $plain = $passwords[$login] ?? 'changeme';
    $stmt->execute([
        'login' => $login,
        'nombre' => $nombre,
        'hash' => password_hash($plain, PASSWORD_DEFAULT),
        'rol' => $rol,
    ]);
}

Configuracion::set('limite_videos_dia', '5');
Configuracion::set('duracion_maxima', '10');

echo "Instalación completada.\n";
echo "Admin: admin / admin123\n";
echo "Docente ejemplo: 123 / admin\n";
