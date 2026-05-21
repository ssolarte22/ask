<?php
session_start();
date_default_timezone_set('America/Bogota');
require_once __DIR__ . '/../inc/database.php';

if (isset($_SESSION['autenticado']) && ($_SESSION['rol'] ?? '') === 'admin') {
    header('Location: homeAdmin.php');
    exit();
}

$error = '';

if (isset($_GET['error'])) {
    $error = 'Credenciales incorrectas. Intente de nuevo.';
}

if (isset($_POST['enviar'])) {
    $login = trim((string) ($_POST['login'] ?? ''));
    $clave = (string) ($_POST['clave'] ?? '');

    $usuario = $login !== '' ? ask_find_user_by_login($login) : null;

    if ($usuario !== null && $usuario['rol'] === 'admin' && password_verify($clave, $usuario['password_hash'])) {
        $_SESSION['autenticado'] = true;
        $_SESSION['rol'] = 'admin';
        $_SESSION['usuario_id'] = (int) $usuario['id'];
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['docente'] = $usuario['nombre'];
        $_SESSION['login'] = $usuario['login'];
        $_SESSION['hora_ingreso'] = date('Y-m-d H:i:s');

        header('Location: homeAdmin.php');
        exit();
    }

    $error = 'Credenciales incorrectas. Intente de nuevo.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrador - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .login-container {
            max-width: 420px;
            margin: 50px auto;
            background: #fff;
            border: 2px solid #002244;
            box-shadow: 10px 10px 0px #D4AF37;
            padding: 30px;
        }
        .login-header { text-align: center; margin-bottom: 25px; }
        .login-header h2 { color: #002244; margin: 0; text-transform: uppercase; font-size: 1.4rem; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #121212; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; box-sizing: border-box; }
        .btn-group { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 25px; }
        .error-msg { background: #fee2e2; color: #991b1b; padding: 10px; text-align: center; margin-bottom: 20px; border: 1px solid #991b1b; font-size: 0.9rem; }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Acceso Administrador</h1>
            <p>Panel de administración - Tutor IA</p>
        </div>
    </div>
</header>

<nav>
    <?php include '../menu.html'; ?>
</nav>

<section>
    <div class="login-container">
        <div class="login-header">
            <h2>Verificar Administrador</h2>
            <p><small>Ingrese sus credenciales para continuar</small></p>
        </div>

        <?php if ($error !== ''): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="login">Usuario / Login:</label>
                <input type="text" id="login" name="login" placeholder="Ej: admin" required>
            </div>

            <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave" placeholder="••••••••" required>
            </div>

            <div class="btn-group">
                <input type="submit" name="enviar" value="Ingresar" class="btn" style="width: 100%; cursor: pointer;">
                <input type="reset" name="restablecer" value="Limpiar" class="btn" style="width: 100%; background: #666; cursor: pointer;">
            </div>
        </form>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | Innovación Educativa</p>
</footer>

</body>
</html>
