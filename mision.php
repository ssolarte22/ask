<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Mayor del Cauca - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
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
        include 'menu.html';
    ?>
</nav>

<section>
     <h2> Misión del Proyecto</h2>

    <p>
        La misión del sistema “Tutor para la creación de videos con inteligencia artificial” es proporcionar 
        una plataforma educativa digital que facilite el aprendizaje y la aplicación de herramientas de IA 
        orientadas a la generación de contenido audiovisual. 
    </p>

    <p>
        Este proyecto busca capacitar a estudiantes y usuarios en el uso eficiente de tecnologías emergentes, 
        específicamente en la construcción de prompts efectivos que permitan obtener resultados claros, 
        estructurados y de alta calidad en la creación de videos automatizados.
    </p>

    <p>
        Asimismo, la plataforma pretende fomentar el pensamiento crítico, la creatividad y la innovación, 
        integrando conceptos de programación, inteligencia artificial y producción multimedia en un entorno 
        accesible, práctico y orientado al aprendizaje autónomo.
    </p>

    <br>

    <h3> Objetivos de la Misión</h3>

    <table>
        <thead>
            <tr>
                <th>Objetivo</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Formación Tecnológica</td>
                <td>Brindar conocimientos sobre el uso de inteligencia artificial aplicada a la creación de videos.</td>
            </tr>
            <tr>
                <td>Optimización de Prompts</td>
                <td>Enseñar a construir instrucciones claras y eficientes para mejorar resultados.</td>
            </tr>
            <tr>
                <td>Accesibilidad</td>
                <td>Ofrecer una herramienta fácil de usar sin requerir conocimientos avanzados.</td>
            </tr>
            <tr>
                <td>Innovación</td>
                <td>Incorporar tecnologías modernas en procesos educativos.</td>
            </tr>
        </tbody>
    </table>
</section>

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