$<?php
    session_start();
    require_once __DIR__ . '/../inc/database.php';
    if(!isset($_SESSION['autenticado'])){
        header ('Location: home.php');
        exit();
    }
    $curso = ask_get_course('curso-2');
    $tituloCurso = $curso['titulo'] ?? 'Curso 2 - Administrador';
$descripcionCurso = $curso['descripcion'] ?? 'Contenido del curso 2 para administración.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso 2 - Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        pre { background: #121212; color: #D4AF37; padding: 20px; border: 2px solid #002244; font-family: 'Courier New', Courier, monospace; margin: 15px 0; overflow-x: auto; border-left: 10px solid #D4AF37; }
        .paso-progreso { border-bottom: 2px dashed #D4AF37; padding: 10px 0; margin-bottom: 10px; }
        .bienvenida-profe { background: #D4AF37; color: #121212; padding: 5px 15px; display: inline-block; font-weight: bold; font-size: 0.9rem; margin-top: 10px; text-transform: uppercase; }
        .analisis-box { background-color: #f0f0f0; border: 2px solid #121212; padding: 20px; margin: 20px 0; }
        .error-box { background: #121212; color: #fff; padding: 20px; border-top: 5px solid #D4AF37; }
        .error-box h3 { color: #fff; margin: 0 0 10px; }
        .error-box p { color: #ddd; }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div class="bienvenida-profe">Administrador: <?php echo htmlspecialchars($_SESSION['usuario'] ?? ($_SESSION['docente'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuAdmin.html'; ?>
</nav>

<section>
    <h2><?php echo htmlspecialchars($tituloCurso, ENT_QUOTES, 'UTF-8'); ?></h2>
    <p><?php echo htmlspecialchars($descripcionCurso, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>El administrador puede revisar la evolución del sistema y la estructura de los contenidos.</p>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

</body>
</html>
