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
    <title>Formación Técnica IA - Colegio Mayor</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilos específicos para la tabla técnica */
        table {
            border: 2px solid #121212;
            margin: 25px 0;
        }
        th {
            background-color: #002244;
            color: #D4AF37;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
        td {
            border: 1px solid #121212;
            padding: 15px;
        }
        .fase-badge {
            background-color: #121212;
            color: #FFFFFF;
            padding: 2px 8px;
            font-weight: bold;
            font-size: 0.8rem;
            display: inline-block;
        }
        blockquote {
            background: #f9f9f9;
            border-left: 10px solid #002244;
            padding: 20px;
            margin: 20px 0;
            border-right: 2px solid #121212;
            border-bottom: 2px solid #121212;
        }
        .check-list {
            list-style: none;
            padding-left: 0;
        }
        .check-list li::before {
            content: "▪";
            color: #D4AF37;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: 0;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div style="background: #D4AF37; color: #121212; padding: 3px 10px; display: inline-block; font-weight: bold; font-size: 0.8rem; margin-top: 10px;">
                DOCENTE: <?php echo htmlspecialchars($_SESSION['docente']); ?>
            </div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuDocente.html'; ?>
</nav>

<section>
    <h2>Formación Técnica en IA para Generación de Video</h2>

    <p>
        Este módulo se centra en comprender cómo funciona internamente la generación de contenido mediante inteligencia artificial, 
        permitiendo al docente tomar decisiones informadas al momento de orientar a los estudiantes.
    </p>

    <div class="tarjeta">
        <h3>¿Cómo interpreta la IA un prompt?</h3>
        <p>
            La inteligencia artificial no “entiende” el lenguaje como un humano; lo procesa mediante patrones probabilísticos. 
            Cada palabra introducida actúa como una variable que inclina el resultado hacia un espacio de datos específico.
        </p>
        <ul class="check-list">
            <li>Análisis de palabras clave (Tokens)</li>
            <li>Detección de intención pedagógica</li>
            <li>Construcción semántica basada en entrenamiento previo</li>
        </ul>
    </div>

    <h3>Flujo interno de procesamiento</h3>

    <table>
        <thead>
            <tr>
                <th>Fase</th>
                <th>Operación de la IA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="fase-badge">01</span> ENTRADA</td>
                <td>Recepción y tokenización del prompt enviado por el usuario.</td>
            </tr>
            <tr>
                <td><span class="fase-badge">02</span> PROCESAMIENTO</td>
                <td>Análisis de contexto, restricciones y objetivos definidos.</td>
            </tr>
            <tr>
                <td><span class="fase-badge">03</span> GENERACIÓN</td>
                <td>Producción de los cuadros de video y síntesis de voz.</td>
            </tr>
        </tbody>
    </table>

    <h3>Variables Críticas de Éxito</h3>
    <p>Para asegurar que la herramienta produzca material de calidad, considere estos cuatro pilares:</p>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0;">
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;">
            <strong>1. Claridad:</strong> Evitar ambigüedades.
        </div>
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;">
            <strong>2. Especificidad:</strong> Nivel de detalle técnico.
        </div>
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;">
            <strong>3. Contexto:</strong> Definición del público objetivo.
        </div>
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;">
            <strong>4. Formato:</strong> Estructura narrativa del video.
        </div>
    </div>

    <h3>Ejemplo de Evolución Técnica</h3>

    <blockquote>
        <p><strong>Prompt Base:</strong> “Explica la inteligencia artificial”</p>
        <p style="color: #881111; font-size: 0.9rem;"><em>Estado: Deficiente (Falta de objetivo y duración)</em></p>
        <hr style="margin: 10px 0; border: 0; border-top: 1px solid #ccc;">
        <p><strong>Prompt Optimizado:</strong> “Genera un video educativo de 30 segundos explicando qué es la inteligencia artificial, con ejemplos simples y lenguaje claro”</p>
        <p style="color: #004400; font-size: 0.9rem;"><em>Estado: Óptimo (Estructura completa)</em></p>
    </blockquote>

</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

<?php include '../Api-key/modal-AI.php'; ?>
<script src="../js/Api.js"></script>

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