<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misión - Tutor IA Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos específicos para destacar la misión */
        .mision-container {
            border-left: 8px solid #D4AF37;
            padding: 20px 30px;
            background: #fff;
            margin-bottom: 40px;
            box-shadow: 6px 6px 0px #002244;
        }

        .mision-container p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #121212;
            margin-bottom: 15px;
        }

        .highlight-text {
            color: #002244;
            font-weight: bold;
        }

        table th {
            background-color: #002244;
            color: #D4AF37;
        }

        .icon-box {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Misión Institucional</h1>
            <p>Innovación, Tecnología y Excelencia</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <h2>Misión del Proyecto</h2>

    <div class="mision-container">
        <span class="icon-box">🚀</span>
        <p>
            La misión del sistema <span class="highlight-text">“Tutor para la creación de videos con inteligencia artificial”</span> es proporcionar 
            una plataforma educativa digital que facilite el aprendizaje y la aplicación de herramientas de IA 
            orientadas a la generación de contenido audiovisual. 
        </p>

        <p>
            Este proyecto busca capacitar a estudiantes y docentes en el uso eficiente de tecnologías emergentes, 
            específicamente en la <span class="highlight-text">construcción de prompts efectivos</span> que permitan obtener resultados claros, 
            estructurados y de alta calidad en la creación de videos automatizados.
        </p>

        <p>
            Asimismo, la plataforma pretende fomentar el pensamiento crítico, la creatividad y la innovación, 
            integrando conceptos de programación, inteligencia artificial y producción multimedia en un entorno 
            accesible, práctico y orientado al aprendizaje autónomo.
        </p>
    </div>

    <h3>Objetivos Estratégicos</h3>

    <table>
        <thead>
            <tr>
                <th>Pilar</th>
                <th>Descripción del Objetivo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold;">Formación Tecnológica</td>
                <td>Brindar conocimientos técnicos sobre el uso de inteligencia artificial aplicada a la creación de videos.</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Optimización de Prompts</td>
                <td>Enseñar a construir instrucciones claras y eficientes para mejorar la precisión de los resultados.</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Accesibilidad</td>
                <td>Ofrecer una herramienta intuitiva que no requiera conocimientos avanzados previos en edición.</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Innovación Educativa</td>
                <td>Incorporar tecnologías disruptivas en los procesos pedagógicos del Colegio Mayor del Cauca.</td>
            </tr>
        </tbody>
    </table>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
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