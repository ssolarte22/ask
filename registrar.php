<?php
session_start();
date_default_timezone_set('America/Bogota');
require_once __DIR__ . '/inc/database.php';

if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header('Location: docente/homeDocente.php');
    exit();
}

$error = '';
$exito = '';
$login = '';
$nombre = '';

if (isset($_POST['registrar'])) {
    $login = trim((string) ($_POST['login'] ?? ''));
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $clave = (string) ($_POST['clave'] ?? '');
    $clave2 = (string) ($_POST['clave_confirmar'] ?? '');

    if ($login === '' || $nombre === '' || $clave === '' || $clave2 === '') {
        $error = 'Completa todos los campos.';
    } elseif (strlen($login) < 3) {
        $error = 'El usuario debe tener al menos 3 caracteres.';
    } elseif (strlen($nombre) < 3) {
        $error = 'El nombre debe tener al menos 3 caracteres.';
    } elseif (strlen($clave) < 3) {
        $error = 'La contraseña debe tener al menos 3 caracteres.';
    } elseif ($clave !== $clave2) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (ask_user_login_exists($login)) {
        $error = 'Ese usuario ya existe. Elige otro.';
    } else {
        ask_create_docente($login, $nombre, $clave);
        $exito = 'Profesor registrado correctamente. Ahora puedes iniciar sesión.';
        $login = '';
        $nombre = '';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesor - Tutor IA Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Registro de Profesor</h1>
            <p>Plataforma de Tutoría IA - Unimayor</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <div class="register-container">
        <div class="register-header">
            <h2>Crear Cuenta Docente</h2>
            <p><small>El usuario se guarda en la base de datos</small></p>
        </div>

        <?php if ($error !== ''): ?>
            <div class="msg-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if ($exito !== ''): ?>
            <div class="msg-ok"><?php echo htmlspecialchars($exito, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form action="registrar.php" method="POST">
            <div class="form-group">
                <label for="login">Usuario</label>
                <input type="text" id="login" name="login" required value="<?php echo htmlspecialchars($login, ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del Profesor</label>
                <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" required>
            </div>

            <div class="form-group">
                <label for="clave_confirmar">Confirmar Contraseña</label>
                <input type="password" id="clave_confirmar" name="clave_confirmar" required>
            </div>

            <div class="btn-row">
                <input type="submit" name="registrar" value="Registrar" class="btn">
                <a href="verificacion.php" class="btn">Iniciar Sesión</a>
            </div>
        </form>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | Innovación Educativa</p>
</footer>

<script>
    const links = document.querySelectorAll("nav a");
    const current = window.location.pathname.split("/").pop();

    links.forEach(link => {
        if (link.getAttribute("href") === current) {
            link.classList.add("active");
        }
    });
</script>

</body>
</html>
