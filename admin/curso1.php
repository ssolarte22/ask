$<?php
    session_start();
    require_once __DIR__ . '/../inc/database.php';
    if(!isset($_SESSION['autenticado'])){
        header ('Location: home.php');
        exit();
    }
    $curso = ask_get_course('curso-1');
$tituloCurso = $curso['titulo'] ?? 'Curso 1 - Administrador';
$descripcionCurso = $curso['descripcion'] ?? 'Contenido del curso 1 para administración.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso 1 - Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        blockquote { background: #fff9e6; border-left: 5px solid #D4AF37; padding: 15px; margin: 20px 0; font-style: italic; font-weight: 500; }
        pre { background: #121212; color: #D4AF37; padding: 15px; border: 1px solid #002244; font-family: 'Courier New', Courier, monospace; margin: 15px 0; overflow-x: auto; }
        hr { border: 0; border-top: 2px solid #ddd; margin: 30px 0; }
        .bienvenida-profe { background: #D4AF37; color: #121212; padding: 5px 15px; display: inline-block; font-weight: bold; font-size: 0.9rem; margin-top: 10px; text-transform: uppercase; }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div class="bienvenida-profe">Bienvenido Administrador: <?php echo htmlspecialchars($_SESSION['usuario'] ?? ($_SESSION['docente'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuAdmin.html'; ?>
</nav>

<section>
    <h2><?php echo htmlspecialchars($tituloCurso, ENT_QUOTES, 'UTF-8'); ?></h2>
    <p><?php echo htmlspecialchars($descripcionCurso, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>El enfoque no es técnico, sino administrativo: revisar, supervisar y validar el proceso general de la plataforma.</p>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

</body>
</html>
