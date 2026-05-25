<?php
    session_start();
    date_default_timezone_set('America/Bogota');
    require_once __DIR__ . '/inc/database.php';

    if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
        header('Location: docente/homeDocente.php');
        exit();
    }

    if (isset($_POST['enviar'])) {
        $login = trim((string) ($_POST['login'] ?? ''));
        $clave = (string) ($_POST['clave'] ?? '');

        $usuario = $login !== '' ? ask_find_user_by_login($login) : null;

        if ($usuario !== null && $usuario['rol'] === 'docente' && password_verify($clave, $usuario['password_hash'])) {
            $_SESSION['docente'] = $usuario['nombre'];
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['usuario_id'] = (int) $usuario['id'];
            $_SESSION['login'] = $usuario['login'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['autenticado'] = true;
            $_SESSION['hora_ingreso'] = date('Y-m-d H:i:s');

            header('Location: docente/homeDocente.php');
            exit();
        }

        $error = "Credenciales incorrectas. Intente de nuevo.";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación - Tutor IA Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Acceso al Sistema</h1>
            <p>Plataforma de Tutoría IA - Unimayor</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <div class="login-container">
        <div class="login-header">
            <h2>Verificar Usuario</h2>
            <p><small>Ingrese sus credenciales para continuar</small></p>
        </div>

        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form action="verificacion.php" method="POST">
            <div class="form-group">
                <label for="login">Usuario / Login:</label>
                <input type="text" id="login" name="login" placeholder="Ej: ivan.beltran" required>
            </div>

            <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave" placeholder="••••••••" required>
            </div>

            <div class="btn-group">
                <input type="submit" name="enviar" value="Ingresar" class="btn">
                <input type="reset" name="restablecer" value="Limpiar" class="btn">
            </div>
        </form>

        <p style="margin-top: 18px; text-align: center;">
            ¿No tienes cuenta? <a href="registrar.php"><strong>Registrar profesor</strong></a>
        </p>

        <p style="margin-top: 8px; text-align: center;">
            ¿Eres administrador? <a href="admin/login.php"><strong>Ingresar como administrador</strong></a>
        </p>

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