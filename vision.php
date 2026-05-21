<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visión - Tutor IA Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos específicos para la sección de Visión */
        .vision-container {
            border-right: 8px solid #D4AF37;
            padding: 20px 30px;
            background: #fff;
            margin-bottom: 40px;
            box-shadow: -6px 6px 0px #002244;
            text-align: right;
        }

        .vision-container p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #121212;
            margin-bottom: 15px;
        }

        .highlight-blue {
            color: #002244;
            font-weight: bold;
        }

        .meta-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }

        table th {
            background-color: #002244;
            color: #D4AF37;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Visión de Futuro</h1>
            <p>Proyección, Innovación y Referencia Tecnológica</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <h2>Visión del Proyecto</h2>

    <div class="vision-container">
        <span class="meta-icon">👁️</span>
        <p>
            Para el año <span class="highlight-blue">2028</span>, el sistema consolidará su posición como una plataforma educativa de referencia en el uso de 
            <span class="highlight-blue">Inteligencia Artificial</span> para la generación de contenido digital, contribuyendo al desarrollo de 
            competencias tecnológicas de vanguardia en estudiantes y profesionales de la región.
        </p>

        <p>
            Se proyecta una evolución integral del sistema mediante la incorporación de funcionalidades avanzadas, 
            personalización profunda de avatares mediante redes neuronales y la integración fluida con múltiples APIs de IA líderes en la industria.
        </p>

        <p>
            A largo plazo, aspiramos a una implementación total en entornos académicos reales, 
            transformando los procesos de enseñanza-aprendizaje mediante el uso de tecnologías disruptivas e innovadoras.
        </p>
    </div>

    <h3>Proyección Estratégica</h3>

    <table>
        <thead>
            <tr>
                <th>Eje de Desarrollo</th>
                <th>Meta Establecida</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold;">Escalabilidad Corporativa</td>
                <td>Integrar un ecosistema de múltiples herramientas de IA en una interfaz unificada.</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Interactividad Avanzada</td>
                <td>Optimizar la experiencia de usuario mediante interfaces dinámicas de baja latencia.</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Impacto Educativo</td>
                <td>Expandir la implementación a diversas facultades e instituciones externas.</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Autonomía del Sistema</td>
                <td>Lograr una generación de contenido autónoma, precisa y con alta fidelidad técnica.</td>
            </tr>
        </tbody>
    </table>

    <div class="tarjeta" style="background: #f4f4f4; border: 1px dashed #002244; margin-top: 40px; text-align: center;">
        <p><em>"Liderando la transición hacia una educación digital inteligente."</em></p>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | Innovación y Tecnología</p>
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