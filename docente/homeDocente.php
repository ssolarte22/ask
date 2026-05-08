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
            <h1>Plataforma Docente - Videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <?php
                session_start();

                if(!isset($_SESSION['autenticado'])){
                    header ('Location: home.php');
                    exit();
                }
            ?>
            <p>Bienvenido Profesor: <?php echo $_SESSION['docente']; ?> </p>
            
        </div>
    </div>
</header>

<nav>
    <?php 
        include 'menuDocente.html';
    ?>
</nav>

<section>

<h2> Guía docente para el uso de IA en la creación de videos</h2>

<p>
Bienvenido al módulo docente de la plataforma. Este espacio ha sido diseñado para orientar el uso pedagógico 
de herramientas de inteligencia artificial enfocadas en la creación de contenido audiovisual.
</p>

<p>
El objetivo principal no es únicamente generar videos, sino comprender cómo la inteligencia artificial puede integrarse 
de manera efectiva en los procesos educativos, promoviendo la creatividad, el análisis crítico y la comunicación digital.
</p>

<h3> Contexto actual</h3>

<p>
La inteligencia artificial está transformando la educación, permitiendo automatizar tareas, generar contenido 
y personalizar el aprendizaje. Sin embargo, su uso requiere orientación docente para evitar resultados superficiales 
o incorrectos.
</p>

<h3> Objetivos del docente dentro de la plataforma</h3>

<ul style="text-align:left;">
<li>Guiar a los estudiantes en el uso de herramientas de IA</li>
<li>Enseñar la correcta formulación de prompts</li>
<li>Evaluar la calidad de los resultados generados</li>
<li>Promover el pensamiento crítico frente a la tecnología</li>
<li>Fomentar la creatividad digital</li>
</ul>

<h3> Flujo de trabajo recomendado</h3>

<table>
<tr><th>Etapa</th><th>Descripción</th><th>Rol docente</th></tr>
<tr>
<td>Exploración</td>
<td>Conocer la herramienta</td>
<td>Explicar funcionamiento</td>
</tr>
<tr>
<td>Creación</td>
<td>Escribir prompts</td>
<td>Guiar estructura</td>
</tr>
<tr>
<td>Generación</td>
<td>Crear video</td>
<td>Supervisar uso</td>
</tr>
<tr>
<td>Análisis</td>
<td>Evaluar resultado</td>
<td>Retroalimentar</td>
</tr>
</table>

<h3> Problemas comunes en el aula</h3>

<ul style="text-align:left;">
<li>Uso de prompts muy generales</li>
<li>Dependencia total de la IA</li>
<li>Falta de análisis del resultado</li>
<li>Confusión entre creatividad y automatización</li>
</ul>

<h3> Recomendaciones clave</h3>

<ul style="text-align:left;">
<li>Siempre pedir justificación del prompt</li>
<li>Comparar resultados entre estudiantes</li>
<li>Enfocar el aprendizaje en el proceso, no solo en el resultado</li>
<li>Usar la IA como apoyo, no como reemplazo</li>
</ul>

</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2025</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

<?php include '../Api-key/modal-AI.php'; ?>
<script src="../js/Api.js"></script>

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