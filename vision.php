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
    <h2> Visión del Proyecto</h2>

    <p>
        La visión del proyecto es consolidarse como una plataforma educativa de referencia en el uso de 
        inteligencia artificial para la generación de contenido digital, contribuyendo al desarrollo de 
        competencias tecnológicas en estudiantes y profesionales.
    </p>

    <p>
        Se proyecta que esta herramienta evolucione integrando nuevas funcionalidades, como generación de 
        videos más avanzados, personalización de avatares, integración con múltiples APIs de IA y mejoras 
        en la experiencia de usuario.
    </p>

    <p>
        A largo plazo, se espera que el sistema pueda ser implementado en entornos académicos reales, 
        apoyando procesos de enseñanza-aprendizaje mediante el uso de tecnologías innovadoras.
    </p>

    <br>

    <h3>Proyección a Futuro</h3>

    <table>
        <thead>
            <tr>
                <th>Aspecto</th>
                <th>Meta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Escalabilidad</td>
                <td>Integrar múltiples herramientas de IA en una sola plataforma.</td>
            </tr>
            <tr>
                <td>Interactividad</td>
                <td>Mejorar la experiencia del usuario con interfaces dinámicas.</td>
            </tr>
            <tr>
                <td>Educación</td>
                <td>Implementación en instituciones educativas.</td>
            </tr>
            <tr>
                <td>Automatización</td>
                <td>Generación de contenido más autónoma y precisa.</td>
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