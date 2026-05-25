<?php
    session_start();
    require_once __DIR__ . '/../inc/database.php';

    if(!isset($_SESSION['autenticado'])){
        header ('Location: home.php');
        exit();
    }

    $mensaje = "";
    $usuario = null;
    $usuarioId = (int) ($_SESSION['usuario_id'] ?? 0);
    $sessionLogin = trim((string) ($_SESSION['login'] ?? ''));

    if ($usuarioId > 0) {
        $usuario = ask_find_user_by_id($usuarioId);
    } elseif ($sessionLogin !== '') {
        $usuario = ask_find_user_by_login($sessionLogin);
        if ($usuario !== null) {
            $_SESSION['usuario_id'] = (int) $usuario['id'];
            $_SESSION['login'] = (string) $usuario['login'];
            $usuarioId = (int) $usuario['id'];
        }
    }

    if(isset($_POST['nuevo_nombre'])){
        $nuevoNombre = trim((string) $_POST['nuevo_nombre']);
        if ($nuevoNombre !== '' && $usuarioId > 0) {
            ask_update_user_name($usuarioId, $nuevoNombre);
            $_SESSION['usuario'] = $nuevoNombre;
            $_SESSION['docente'] = $nuevoNombre;
            $usuario = ask_find_user_by_id($usuarioId) ?: $usuario;
            $mensaje = "Nombre actualizado correctamente.";
        } elseif ($nuevoNombre !== '' && $sessionLogin !== '') {
            ask_update_user_name_by_login($sessionLogin, $nuevoNombre);
            $_SESSION['usuario'] = $nuevoNombre;
            $_SESSION['docente'] = $nuevoNombre;
            $usuario = ask_find_user_by_login($sessionLogin) ?: $usuario;
            $mensaje = "Nombre actualizado correctamente.";
        }
    }

    $nombrePerfil = $usuario['nombre'] ?? ($_SESSION['usuario'] ?? '');
    $loginPerfil = $usuario['login'] ?? ($_SESSION['login'] ?? '');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Administrador - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .perfil-container { display: flex; gap: 30px; flex-wrap: wrap; margin-top: 20px; }
        .info-card { flex: 1; min-width: 300px; border: 2px solid #121212; padding: 25px; background: #fff; box-shadow: 8px 8px 0px #D4AF37; }
        .status-badge { background-color: #004400; color: #fff; padding: 2px 10px; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; }
        .label-perfil { font-weight: bold; color: #002244; text-transform: uppercase; font-size: 0.85rem; display: block; margin-top: 15px; border-bottom: 1px solid #eee; }
        .dato-perfil { font-size: 1.1rem; margin-bottom: 10px; color: #121212; }
        .form-perfil { background-color: #f9f9f9; border: 2px solid #002244; padding: 20px; margin-top: 30px; }
        .exito-msg { background: #dcfce7; color: #166534; padding: 10px; border: 1px solid #166534; margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>

<?php include 'top_admin.php'; ?>

<section>
    <h2>Perfil del Administrador</h2>
    <div class="perfil-container">
        <div class="info-card">
            <h3>Datos de Usuario</h3>
            <span class="label-perfil">Nombre Completo</span>
            <p class="dato-perfil"><?php echo htmlspecialchars($nombrePerfil, ENT_QUOTES, 'UTF-8'); ?></p>
            <span class="label-perfil">Usuario</span>
            <p class="dato-perfil"><?php echo htmlspecialchars($loginPerfil, ENT_QUOTES, 'UTF-8'); ?></p>
            <span class="label-perfil">Estado de Cuenta</span>
            <p class="dato-perfil"><span class="status-badge">Activo</span></p>
            <span class="label-perfil">Último Ingreso</span>
            <p class="dato-perfil"><?php echo htmlspecialchars($_SESSION['hora_ingreso'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div style="flex: 1; min-width: 300px;">
            <h3>Privilegios en Plataforma</h3>
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Control de usuarios</td><td style="color: #006600; font-weight: bold;">✓ Disponible</td></tr>
                    <tr><td>Supervisión de contenido</td><td style="color: #006600; font-weight: bold;">✓ Habilitado</td></tr>
                    <tr><td>Gestión de cursos</td><td style="color: #006600; font-weight: bold;">✓ Completo</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr style="margin: 40px 0; border: 1px solid #eee;">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        <div>
            <h3>Configuración de Cuenta</h3>
            <form method="post" class="form-perfil">
                <label>Modificar Nombre de Usuario</label>
                <input type="text" name="nuevo_nombre" placeholder="Escriba su nuevo nombre" required>
                <input type="submit" value="Actualizar Datos">
                <?php if ($mensaje !== ''): ?>
                    <div class="exito-msg"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>
            </form>
        </div>

        <div>
            <h3>Propósito del Acceso</h3>
            <p>
                Este perfil representa el acceso oficial del administrador a la plataforma de inteligencia artificial del <strong>Colegio Mayor del Cauca</strong>.
            </p>
            <p>
                Como administrador, puedes supervisar y gestionar la información del sistema.
            </p>
        </div>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

</body>
</html>
