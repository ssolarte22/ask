<?php
    session_start();
    if(!isset($_SESSION['autenticado'])){
        header ('Location: home.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Docente - Colegio Mayor del Cauca</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilos específicos para el Dashboard */
        .welcome-box {
            background: #D4AF37;
            color: #121212;
            padding: 8px 15px;
            display: inline-block;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85rem;
            margin-top: 10px;
            border: 1px solid #121212;
        }
        .grid-objetivos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }
        .objetivo-item {
            background: #fff;
            border: 2px solid #002244;
            padding: 15px;
            border-left: 8px solid #D4AF37;
        }
        .check-list {
            list-style: none;
            padding: 0;
        }
        .check-list li::before {
            content: "▪ ";
            color: #D4AF37;
            font-weight: bold;
        }
        .panel-academico {
            background: #fcfdff;
            border: none;
            border-left: 8px solid #D4AF37;
            padding: 20px;
            margin-top: 20px;
        }
        .panel-academico h3 {
            color: #002244;
            border-left: none;
            padding-left: 0;
            margin-bottom: 1rem;
        }
        .panel-academico p {
            color: #333;
        }
        .panel-academico .btn {
            margin-right: 10px;
            margin-top: 5px;
        }
        .dual-panel {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            background: #fcfdff;
            border: 2px solid #002244;
            box-shadow: 6px 6px 0px #D4AF37;
        }
        table {
            border: 2px solid #121212;
        }
        th {
            background-color: #002244;
            color: #D4AF37;
        }
    </style>
</head>
<body>

<?php include 'top_docente.php'; ?>

<section>
    <h2>Guía docente para el uso de IA en la creación de videos</h2>

    <p>
        Bienvenido al módulo docente de la plataforma. Este espacio ha sido diseñado para orientar el uso pedagógico 
        de herramientas de inteligencia artificial enfocadas en la creación de contenido audiovisual de alto impacto.
    </p>

    <div class="panel-academico">
        <h3>Gestión académica</h3>
        <p>Desde aquí puedes crear tus cursos y registrar estudiantes en cada curso.</p>
        <a href="cursos.php" class="btn" style="margin-right:10px;">Cursos</a>
        <a href="estudiantes.php" class="btn">Estudiantes</a>
    </div>

    <div class="tarjeta">
        <h3>Propósito Pedagógico</h3>
        <p>
            El objetivo principal no es únicamente generar videos, sino comprender cómo la inteligencia artificial puede integrarse 
            de manera efectiva en los procesos educativos, promoviendo la creatividad, el análisis crítico y la comunicación digital.
        </p>
    </div>

    <h3>Objetivos Estratégicos</h3>
    <div class="grid-objetivos">
        <div class="objetivo-item">Guiar a los estudiantes en el uso ético de herramientas de IA.</div>
        <div class="objetivo-item">Enseñar la ingeniería de prompts para resultados precisos.</div>
        <div class="objetivo-item">Evaluar la calidad técnica y pedagógica de los videos.</div>
        <div class="objetivo-item">Fomentar la creatividad digital y el pensamiento crítico.</div>
    </div>

    <h3>Flujo de Trabajo Recomendado</h3>
    <table>
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Descripción</th>
                <th>Rol Docente</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Exploración</strong></td>
                <td>Conocimiento de la interfaz y herramientas.</td>
                <td>Facilitador técnico</td>
            </tr>
            <tr>
                <td><strong>Creación</strong></td>
                <td>Diseño y escritura de prompts estructurados.</td>
                <td>Mentor de contenido</td>
            </tr>
            <tr>
                <td><strong>Generación</strong></td>
                <td>Renderizado y producción del video con IA.</td>
                <td>Supervisor de proceso</td>
            </tr>
            <tr>
                <td><strong>Análisis</strong></td>
                <td>Evaluación crítica del video obtenido.</td>
                <td>Evaluador / Feedback</td>
            </tr>
        </tbody>
    </table>

    <div style="display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap;">
        <div class="dual-panel">
            <h3 style="color: #002244;">Problemas Comunes</h3>
            <ul class="check-list">
                <li>Uso de prompts excesivamente vagos.</li>
                <li>Dependencia técnica sin criterio pedagógico.</li>
                <li>Falta de validación de la información generada.</li>
                <li>Confusión entre automatización y creación real.</li>
            </ul>
        </div>

        <div class="dual-panel">
            <h3 style="color: #002244;">Recomendaciones Clave</h3>
            <ul class="check-list">
                <li>Solicitar siempre la justificación del prompt.</li>
                <li>Comparar diversos resultados para el mismo tema.</li>
                <li>Priorizar el proceso de diseño sobre el video final.</li>
                <li>Integrar la IA como un asistente, no como sustituto.</li>
            </ul>
        </div>
    </div>

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