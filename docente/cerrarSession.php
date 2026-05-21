<?php
    // Primero procesamos la lógica de cierre antes de cualquier HTML
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    // Nota: Si quieres que el usuario vea el mensaje, comenta la línea del header de abajo
    header('location: ../home.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Cerrada - Colegio Mayor del Cauca</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
        </div>
    </div>
</header>

<nav>
    <?php 
        // Aunque se está cerrando, mantenemos el menú por estructura visual
        include 'menuDocente.html';
    ?>
</nav>

<section>
    <h2>Sesión Finalizada</h2>
    <div class="tarjeta"> <p>Gracias por utilizar el tutorial de Inteligencia Artificial.</p>
        <p>Has salido del sistema de forma segura.</p>
        <br>
        <a href="../home.php" class="btn">Volver al Inicio</a>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

<script>
    // Script para manejar el estado activo del menú
    const links = document.querySelectorAll("nav a");
    const current = window.location.pathname.split("/").pop();

    links.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href") === current) {
            link.classList.add("active");
        }
    });
</script>

</body>
</html>