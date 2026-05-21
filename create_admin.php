<?php
require_once __DIR__ . '/inc/database.php';

try {
    $pdo = ask_db_connection();
} catch (Throwable $e) {
    echo "Error conectando a la base de datos: " . htmlspecialchars($e->getMessage());
    exit(1);
}

$login = 'admin';
$nombre = 'Administrador';
$clave = 'admin123';

// Upsert admin user
$stmt = $pdo->prepare(
    'INSERT INTO usuarios (login, nombre, password_hash, rol, videos_generados, activo)
     VALUES (:login, :nombre, :hash, :rol, 0, 1)
     ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), password_hash = VALUES(password_hash), rol = VALUES(rol), activo = VALUES(activo)'
);

$ok = $stmt->execute([
    'login' => $login,
    'nombre' => $nombre,
    'hash' => password_hash($clave, PASSWORD_DEFAULT),
    'rol' => 'admin',
]);

if ($ok) {
    echo "Usuario admin creado/actualizado correctamente.\n";
    echo "Login: {$login}  Contraseña: {$clave}\n";
    echo "Por seguridad, borra este archivo create_admin.php tras el uso.";
    exit(0);
}

echo "No se pudo crear el admin. Revisa permisos y conexión a la BD.";
exit(1);
