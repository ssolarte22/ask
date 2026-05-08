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

<h2>Curso Docente 2: Enseñanza avanzada de prompts</h2>

<p>
Este módulo está enfocado en enseñar al docente cómo llevar a los estudiantes desde prompts básicos
hasta estructuras más completas y efectivas.
</p>

<p>
Aquí el docente ya no solo guía, sino que ayuda a analizar, mejorar y optimizar las instrucciones.
</p>

<h3> Objetivo del curso</h3>

<p>
Capacitar al docente para enseñar la optimización de prompts mediante un proceso estructurado y progresivo.
</p>

<hr>

<h3>🪜 Metodología paso a paso</h3>

<h4>1. Partir de un prompt básico</h4>

<pre>
Haz un video sobre IA
</pre>

<p>
El docente debe usar este ejemplo para mostrar que un prompt simple genera resultados limitados.
</p>

---

<h4>2. Identificar problemas junto al estudiante</h4>

<ul style="text-align:left;">
<li>No define duración</li>
<li>No define objetivo</li>
<li>No especifica estilo</li>
<li>No indica público</li>
</ul>

<p>
Este paso es clave: el docente debe hacer que el estudiante detecte los errores por sí mismo.
</p>

---

<h4>3. Introducir mejoras paso a paso</h4>

<p>El docente mejora el prompt de forma progresiva:</p>

<pre>
Paso 1: Haz un video de 30 segundos sobre IA
Paso 2: Haz un video de 30 segundos explicando la IA
Paso 3: Haz un video educativo de 30 segundos explicando la IA
Paso 4: Genera un video educativo de 30 segundos explicando la inteligencia artificial, con ejemplos simples
</pre>

---

<h4>4. Analizar el impacto de cada cambio</h4>

<p>
El docente debe explicar cómo cada elemento mejora el resultado:
</p>

<ul style="text-align:left;">
<li>Duración → controla el tamaño del contenido</li>
<li>Objetivo → define qué se hace</li>
<li>Estilo → define cómo se presenta</li>
<li>Detalle → mejora la calidad</li>
</ul>

---

<h4>5. Fomentar la iteración</h4>

<p>
El docente debe dejar claro que un prompt no es definitivo.
Se mejora constantemente.
</p>

---

<h3> Ejemplo final optimizado</h3>

<pre>
Genera un video educativo de 15 segundos explicando la inteligencia artificial,
con ejemplos simples, lenguaje claro y dirigido a estudiantes.
</pre>

---

<h3> Error común del docente</h3>

<p>
Corregir directamente el prompt sin permitir que el estudiante participe en el proceso de mejora.
</p>

---

<h3> Resultado esperado</h3>

<p>
El docente será capaz de enseñar cómo construir prompts completos, claros y efectivos,
y cómo mejorar continuamente los resultados generados por la IA.
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