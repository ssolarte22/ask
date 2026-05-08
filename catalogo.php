<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de IA - Tutor Videos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon"></span>
        <div>
            <h1>Catálogo de Herramientas IA</h1>
            <p>Explora, compara y aprende a usar generadores de video</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>

    <h2> Catálogo de Inteligencias Artificiales para Video</h2>

    <p>
    Este catálogo presenta las principales herramientas de inteligencia artificial utilizadas para la generación 
    de contenido audiovisual. Cada herramienta tiene características específicas que determinan su uso según 
    el contexto, la complejidad del proyecto y el nivel técnico del usuario.
    </p>

    <br>

    <h3> Comparación General</h3>

    <table>
        <thead>
            <tr>
                <th>IA</th>
                <th>Tipo de Video</th>
                <th>Facilidad</th>
                <th>Gratis</th>
                <th>Uso recomendado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D-ID</td>
                <td>Avatar con voz</td>
                <td>Fácil</td>
                <td>Parcial</td>
                <td>Explicaciones y educación</td>
            </tr>
            <tr>
                <td>Runway ML</td>
                <td>Video generado por IA</td>
                <td>Difícil</td>
                <td>Parcial</td>
                <td>Producción avanzada</td>
            </tr>
            <tr>
                <td>Pika Labs</td>
                <td>Clips animados</td>
                <td>Fácil</td>
                <td>Sí</td>
                <td>Redes sociales</td>
            </tr>
            <tr>
                <td>HeyGen</td>
                <td>Avatar corporativo</td>
                <td>Media</td>
                <td>Parcial</td>
                <td>Marketing</td>
            </tr>
            <tr>
                <td>Synthesia</td>
                <td>Presentador IA</td>
                <td>Media</td>
                <td>No</td>
                <td>Capacitación empresarial</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h3> Nivel Técnico y Complejidad</h3>

    <table>
        <thead>
            <tr>
                <th>Herramienta</th>
                <th>Requiere Programación</th>
                <th>Uso de API</th>
                <th>Curva de aprendizaje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D-ID</td>
                <td>No obligatorio</td>
                <td>Sí</td>
                <td>Baja</td>
            </tr>
            <tr>
                <td>Runway ML</td>
                <td>Sí</td>
                <td>Sí</td>
                <td>Alta</td>
            </tr>
            <tr>
                <td>Pika Labs</td>
                <td>No</td>
                <td>No</td>
                <td>Baja</td>
            </tr>
            <tr>
                <td>HeyGen</td>
                <td>No</td>
                <td>Opcional</td>
                <td>Media</td>
            </tr>
            <tr>
                <td>Synthesia</td>
                <td>No</td>
                <td>Limitado</td>
                <td>Media</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h3> Ejemplos de Prompts por Herramienta</h3>

    <table>
        <thead>
            <tr>
                <th>Herramienta</th>
                <th>Prompt Recomendado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D-ID</td>
                <td>Explica qué es la inteligencia artificial en 30 segundos con tono educativo.</td>
            </tr>
            <tr>
                <td>Pika Labs</td>
                <td>Un robot caminando en una ciudad futurista con luces neón.</td>
            </tr>
            <tr>
                <td>Runway ML</td>
                <td>Escena cinematográfica de un astronauta explorando Marte.</td>
            </tr>
            <tr>
                <td>HeyGen</td>
                <td>Presentación de un producto tecnológico con tono profesional.</td>
            </tr>
            <tr>
                <td>Synthesia</td>
                <td>Video educativo explicando bases de datos para estudiantes.</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h3> Ventajas y Desventajas</h3>

    <table>
        <thead>
            <tr>
                <th>Herramienta</th>
                <th>Ventajas</th>
                <th>Desventajas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D-ID</td>
                <td>Fácil integración, rápida generación</td>
                <td>Limitado por créditos</td>
            </tr>
            <tr>
                <td>Runway ML</td>
                <td>Alta calidad</td>
                <td>Complejo y pesado</td>
            </tr>
            <tr>
                <td>Pika Labs</td>
                <td>Rápido y simple</td>
                <td>Videos muy cortos</td>
            </tr>
            <tr>
                <td>HeyGen</td>
                <td>Profesional</td>
                <td>Pago</td>
            </tr>
            <tr>
                <td>Synthesia</td>
                <td>Muy realista</td>
                <td>No gratuito</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h3> Prueba la IA integrada</h3>

    <p>
    Puedes probar directamente la generación de video usando la herramienta integrada en la plataforma.
    Esto permite aplicar lo aprendido sobre prompts en un entorno real.
    </p>

    <br>

</section>

<footer>
    <p>© 2025 Tutor IA - Colegio Mayor del Cauca</p>
</footer>


<script>
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