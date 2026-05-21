<?php
    session_start();
    require_once __DIR__ . '/../inc/database.php';
    if(!isset($_SESSION['autenticado'])){
        header ('Location: home.php');
        exit();
    }

    $curso = ask_get_course('curso-2');
    $tituloCurso = $curso['titulo'] ?? 'Curso 2 - Enseñanza Avanzada - Colegio Mayor';
    $descripcionCurso = $curso['descripcion'] ?? 'Este módulo está enfocado en enseñar al docente cómo llevar a los estudiantes desde prompts básicos hasta estructuras más completas.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso 2 - Enseñanza Avanzada - Colegio Mayor</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Consistencia con Curso 1 */
        pre {
            background: #121212;
            color: #D4AF37;
            padding: 20px;
            border: 2px solid #002244;
            font-family: 'Courier New', Courier, monospace;
            margin: 15px 0;
            overflow-x: auto;
            border-left: 10px solid #D4AF37; /* Acento dorado lateral */
        }
        .paso-progreso {
            border-bottom: 2px dashed #D4AF37;
            padding: 10px 0;
            margin-bottom: 10px;
        }
        .bienvenida-profe {
            background: #D4AF37;
            color: #121212;
            padding: 5px 15px;
            display: inline-block;
            font-weight: bold;
            font-size: 0.9rem;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .analisis-box {
            background-color: #f0f0f0;
            border: 2px solid #121212;
            padding: 20px;
            margin: 20px 0;
        }
        .error-box {
            background: #121212;
            color: #fff;
            padding: 20px;
            border-top: 5px solid #D4AF37;
        }
        .error-box h3 { color: #fff; margin: 0 0 10px; }
        .error-box p { color: #ddd; }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div class="bienvenida-profe">
                Profesor: <?php echo htmlspecialchars($_SESSION['docente']); ?>
            </div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuDocente.html'; ?>
</nav>

<section>
    <h2><?php echo htmlspecialchars($tituloCurso, ENT_QUOTES, 'UTF-8'); ?></h2>

    <p>
        <?php echo htmlspecialchars($descripcionCurso, ENT_QUOTES, 'UTF-8'); ?>
    </p>

    <div class="tarjeta">
        <h3>Objetivo del curso</h3>
        <p>
            Capacitar al docente para enseñar la optimización de prompts mediante un proceso estructurado, 
            crítico y progresivo.
        </p>
    </div>

    <hr style="border: 1px solid #ddd; margin: 30px 0;">

    <h3>🪜 Metodología paso a paso</h3>

    <h4>1. El punto de partida (Prompt Básico)</h4>
    <p>Inicie mostrando cómo un prompt demasiado simple limita el potencial de la IA:</p>
    <pre>Haz un video sobre IA</pre>

    <h4>2. Auditoría conjunta con el estudiante</h4>
    <p>En lugar de dar la respuesta, use este cuadro de análisis para que el estudiante detecte vacíos:</p>
    
    <div class="analisis-box">
        <ul style="list-style-type: '❌ '; margin-left: 20px;">
            <li><strong>Duración:</strong> ¿Es de 10 segundos o de 10 minutos?</li>
            <li><strong>Objetivo:</strong> ¿Es para informar, vender o entretener?</li>
            <li><strong>Estilo:</strong> ¿Serio, animado, cinematográfico?</li>
            <li><strong>Público:</strong> ¿Niños, universitarios o expertos?</li>
        </ul>
    </div>

    <h4>3. Construcción Progresiva</h4>
    <p>Muestre la evolución del comando paso a paso:</p>
    
    <div style="background: white; border: 1px solid #002244; padding: 15px;">
        <div class="paso-progreso"><strong>Paso 1:</strong> Haz un video de 30 segundos sobre IA.</div>
        <div class="paso-progreso"><strong>Paso 2:</strong> Haz un video educativo de 30 segundos explicando la IA.</div>
        <div class="paso-progreso"><strong>Paso 3:</strong> Genera un video educativo de 30 segundos explicando la IA, con ejemplos de la vida diaria.</div>
    </div>

    <h4>4. El Resultado Final Optimizado</h4>
    <p>Un prompt profesional debe verse así:</p>
    <pre>
Genera un video educativo de 15 segundos explicando la inteligencia artificial, 
con ejemplos simples, lenguaje claro y dirigido a estudiantes de secundaria.
    </pre>

    <div class="error-box">
        <h3>⚠️ Error común a evitar</h3>
        <p>
            Corregir directamente el prompt del estudiante. El valor pedagógico está en que 
            <strong>el estudiante aprenda a identificar qué falta</strong> en su instrucción.
        </p>
    </div>

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