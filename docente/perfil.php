<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Mayor del Cauca - Inicio</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Si está en una carpeta css/, usa: href="css/estilos.css" -->
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creacion de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
        </div>
    </div>
</header>

<nav>
    <?php 
        include 'menuDocente.html';
    ?>
</nav>


<?php session_start(); ?>

<section>

<h2> Perfil del Docente</h2>

<p><strong>Nombre:</strong> <?php echo $_SESSION['docente']; ?></p>
<p><strong>Estado:</strong> Activo</p>
<p><strong>Fecha de ingreso:</strong> <?php echo $_SESSION['hora_ingreso']; ?></p>

<hr>

<h3> Actividad en la plataforma</h3>

<table>
<tr><th>Acción</th><th>Estado</th></tr>
<tr><td>Uso de IA</td><td>Disponible</td></tr>
<tr><td>Generación de videos</td><td>Habilitado</td></tr>
<tr><td>Acceso a cursos</td><td>Completo</td></tr>
</table>

<hr>

<h3> Uso dentro del sistema</h3>

<p>
Este perfil representa el acceso del docente a las herramientas de generación de contenido con inteligencia artificial.
Desde aquí puede interactuar con el sistema, generar videos mediante prompts y gestionar su experiencia dentro de la plataforma.
</p>

<p>
El docente tiene acceso a módulos de formación, cursos y herramientas que le permiten mejorar progresivamente
su uso de la inteligencia artificial en entornos educativos.
</p>

<hr>

<h3> Configuración básica</h3>

<form method="post">
    <label>Nombre del docente</label>
    <input type="text" name="nuevo_nombre" placeholder="Actualizar nombre">

    <input type="submit" value="Actualizar">
</form>

<?php
if(isset($_POST['nuevo_nombre'])){
    $_SESSION['docente'] = $_POST['nuevo_nombre'];
    echo "<p>Nombre actualizado correctamente</p>";
}
?>

<hr>

<h3> Objetivo dentro de la plataforma</h3>

<p>
Utilizar herramientas de inteligencia artificial para la creación de contenido educativo, 
mejorando la calidad de los recursos digitales y fortaleciendo las estrategias de enseñanza.
</p>

</section>

<?php include '../Api-key/modal-AI.php'; ?>
<script src="../js/Api.js"></script>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2025</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

<script>
const links = document.querySelectorAll("nav a");
const current = window.location.pathname.split("/").pop();

links.forEach(link => {
    link.classList.remove("active"); // 🔥 limpia todos
    if (link.getAttribute("href") === current) {
        link.classList.add("active");
    }
});
</script>

</body>
</html>