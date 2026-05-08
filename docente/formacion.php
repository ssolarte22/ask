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
<section>

<h2> Formación Técnica en IA para Generación de Video</h2>

<p>
Este módulo se centra en comprender cómo funciona internamente la generación de contenido mediante inteligencia artificial,
permitiendo al docente tomar decisiones informadas al momento de orientar a los estudiantes.
</p>

<h3> ¿Cómo interpreta la IA un prompt?</h3>

<p>
La inteligencia artificial no “entiende” como un humano, sino que procesa el texto como patrones. 
Cada palabra del prompt influye directamente en el resultado final.
</p>

<ul style="text-align:left;">
<li>🔹 Analiza palabras clave</li>
<li>🔹 Detecta intención</li>
<li>🔹 Construye una respuesta basada en entrenamiento previo</li>
</ul>

<h3> Flujo interno simplificado</h3>

<table>
<tr><th>Fase</th><th>Qué hace la IA</th></tr>
<tr>
<td>Entrada</td>
<td>Recibe el prompt</td>
</tr>
<tr>
<td>Procesamiento</td>
<td>Analiza contexto y palabras clave</td>
</tr>
<tr>
<td>Generación</td>
<td>Produce el video</td>
</tr>
</table>

<h3> Variables que afectan el resultado</h3>

<ul style="text-align:left;">
<li><strong>Claridad:</strong> qué tan entendible es el prompt</li>
<li><strong>Especificidad:</strong> nivel de detalle</li>
<li><strong>Contexto:</strong> a quién va dirigido</li>
<li><strong>Formato:</strong> cómo está estructurado</li>
</ul>

<h3> Concepto clave para el docente</h3>

<p>
Un mismo tema puede generar resultados completamente diferentes dependiendo de cómo se formule el prompt. 
Por eso, el aprendizaje debe centrarse en la construcción de instrucciones, no en la herramienta.
</p>

<h3> Ejemplo técnico</h3>

<blockquote>
<p><strong>Prompt:</strong> “Explica la inteligencia artificial”</p>
<p><strong>Problema:</strong> Falta de contexto y objetivo</p>
</blockquote>

<blockquote>
<p><strong>Prompt mejorado:</strong> “Genera un video educativo de 30 segundos explicando qué es la inteligencia artificial, con ejemplos simples y lenguaje claro”</p>
<p><strong>Resultado:</strong> Mayor precisión y utilidad</p>
</blockquote>

</section>
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