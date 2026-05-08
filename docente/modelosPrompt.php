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

<h2> Modelos de construcción de prompts</h2>

<p>
Este módulo proporciona estructuras que el docente puede utilizar como guía para enseñar la creación de prompts
de forma organizada y progresiva.
</p>

<p>
No todos los prompts deben ser complejos, pero sí deben tener una estructura lógica.
</p>

<hr>

<h3> Modelo 1: Prompt básico</h3>

<p>
Es el primer acercamiento del estudiante a la IA. Se caracteriza por ser simple y directo.
</p>

<pre>
[Acción] + [Tema]
</pre>

<p><strong>Ejemplo:</strong></p>

<pre>
Explica la inteligencia artificial
</pre>

<p>
Este modelo permite entender la interacción básica, pero produce resultados limitados.
</p>

---

<h3> Modelo 2: Prompt estructurado</h3>

<p>
Se añade intención y contexto, mejorando la calidad del resultado.
</p>

<pre>
[Acción] + [Tema] + [Objetivo]
</pre>

<p><strong>Ejemplo:</strong></p>

<pre>
Explica la inteligencia artificial para estudiantes
</pre>

---

<h3> Modelo 3: Prompt completo</h3>

<p>
Este modelo incluye todos los elementos necesarios para obtener resultados de alta calidad.
</p>

<pre>
[Acción] + [Duración] + [Tema] + [Objetivo] + [Estilo] + [Público]
</pre>

<p><strong>Ejemplo:</strong></p>

<pre>
Genera un video educativo de 40 segundos explicando la inteligencia artificial,
con ejemplos simples, lenguaje claro y dirigido a estudiantes.
</pre>

---

<h3> Análisis comparativo</h3>

<table>
<tr><th>Modelo</th><th>Complejidad</th><th>Calidad</th></tr>
<tr><td>Básico</td><td>Baja</td><td>Baja</td></tr>
<tr><td>Estructurado</td><td>Media</td><td>Media</td></tr>
<tr><td>Completo</td><td>Alta</td><td>Alta</td></tr>
</table>

---

<h3> Cómo debe enseñarlo el docente</h3>

<ul style="text-align:left;">
<li>Empezar con el modelo básico</li>
<li>Avanzar progresivamente</li>
<li>Mostrar ejemplos reales</li>
<li>Comparar resultados</li>
</ul>

---

<h3> Buenas prácticas</h3>

<ul style="text-align:left;">
<li>Ser claro y específico</li>
<li>Evitar ambigüedad</li>
<li>Definir objetivo</li>
<li>Usar lenguaje simple</li>
</ul>

---

<h3> Malas prácticas</h3>

<ul style="text-align:left;">
<li>Prompts demasiado cortos</li>
<li>Falta de contexto</li>
<li>Instrucciones vagas</li>
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