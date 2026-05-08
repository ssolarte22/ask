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

<h2> Curso Docente 1: Introducción a la enseñanza de prompts</h2>

<p>
Este módulo está orientado a que el docente comprenda cómo enseñar la construcción de prompts desde cero,
sin asumir conocimientos previos en los estudiantes.
</p>

<p>
El enfoque no es técnico, sino pedagógico: el docente debe aprender a guiar, observar y corregir el proceso
de construcción de instrucciones que los estudiantes utilizan para interactuar con la inteligencia artificial.
</p>

<h3> Objetivo del curso</h3>

<p>
Capacitar al docente para introducir la creación de prompts de manera clara, progresiva y comprensible,
evitando sobrecargar al estudiante en las primeras etapas.
</p>

<hr>

<h3> Metodología paso a paso para el docente</h3>

<h4>1. Explicar el concepto de prompt</h4>
<p>
Antes de pedir cualquier actividad, el docente debe dejar claro que un prompt es una instrucción,
similar a una pregunta o indicación que se le da a una herramienta para obtener un resultado.
</p>

<blockquote>
Un prompt es la forma en que nos comunicamos con la inteligencia artificial.
</blockquote>

---

<h4>2. Iniciar con ejemplos simples</h4>

<p>
El docente debe comenzar con ejemplos básicos, incluso incompletos, para que el estudiante entienda la lógica.
</p>

<pre>
Ejemplo: "Explica la inteligencia artificial"
</pre>

<p>
En esta etapa no importa que el prompt sea imperfecto, lo importante es que el estudiante entienda que
la IA responde a lo que se le pide.
</p>

---

<h4>3. Pedir observación del resultado</h4>

<p>
El docente debe hacer preguntas como:
</p>

<ul style="text-align:left;">
<li>¿El resultado fue claro?</li>
<li>¿Qué faltó?</li>
<li>¿Qué mejorarías?</li>
</ul>

<p>
Aquí comienza el desarrollo del pensamiento crítico.
</p>

---

<h4>4. Introducir la mejora progresiva</h4>

<p>
El docente muestra cómo mejorar el mismo prompt sin hacerlo complejo.
</p>

<pre>
Genera un video explicando la inteligencia artificial
</pre>

<p>
El objetivo es que el estudiante entienda que un pequeño cambio mejora el resultado.
</p>

---

<h4>5. Evitar complejidad temprana</h4>

<p>
Uno de los errores más comunes del docente es introducir demasiados elementos al mismo tiempo
(duración, estilo, público, etc.).
</p>

<p>
En esta fase, el aprendizaje debe ser gradual.
</p>

---

<h3>Estrategia pedagógica recomendada</h3>

<ul style="text-align:left;">
<li>Trabajar con ejemplos reales</li>
<li>Permitir errores</li>
<li>Fomentar comparación de resultados</li>
<li>Guiar en lugar de imponer</li>
</ul>

---

<h3> Errores que el docente debe evitar</h3>

<ul style="text-align:left;">
<li>Explicar todo de una sola vez</li>
<li>No analizar los resultados generados</li>
<li>Enfocarse solo en el resultado final</li>
<li>No permitir experimentación</li>
</ul>

---

<h3> Resultado esperado</h3>

<p>
Al finalizar este curso, el docente será capaz de introducir correctamente el concepto de prompt
y guiar a los estudiantes en la construcción de instrucciones básicas.
</p>

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