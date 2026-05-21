<?php
    session_start();
    require_once __DIR__ . '/../inc/database.php';
    if(!isset($_SESSION['autenticado'])){
        header ('Location: home.php');
        exit();
    }

    $curso = ask_get_course('curso-1');
    $tituloCurso = $curso['titulo'] ?? 'Curso 1 - Tutor IA Colegio Mayor';
    $descripcionCurso = $curso['descripcion'] ?? 'Este módulo está orientado a que el docente comprenda cómo enseñar la construcción de prompts desde cero.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso 1 - Tutor IA Colegio Mayor</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Ajustes específicos para elementos de este curso */
        blockquote {
            background: #fff9e6;
            border-left: 5px solid #D4AF37;
            padding: 15px;
            margin: 20px 0;
            font-style: italic;
            font-weight: 500;
        }
        pre {
            background: #121212;
            color: #D4AF37;
            padding: 15px;
            border: 1px solid #002244;
            font-family: 'Courier New', Courier, monospace;
            margin: 15px 0;
            overflow-x: auto;
        }
        hr {
            border: 0;
            border-top: 2px solid #ddd;
            margin: 30px 0;
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
                Bienvenido Profesor: <?php echo htmlspecialchars($_SESSION['docente']); ?>
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

    <p>
        El enfoque no es técnico, sino pedagógico: el docente debe aprender a guiar, observar y corregir el proceso
        de construcción de instrucciones que los estudiantes utilizan para interactuar con la inteligencia artificial.
    </p>

    <div class="tarjeta">
        <h3>Objetivo del curso</h3>
        <p>
            Capacitar al docente para introducir la creación de prompts de manera clara, progresiva y comprensible,
            evitando sobrecargar al estudiante en las primeras etapas.
        </p>
    </div>

    <hr>

    <h3>Metodología paso a paso para el docente</h3>

    <h4>1. Explicar el concepto de prompt</h4>
    <p>
        Antes de pedir cualquier actividad, el docente debe dejar claro que un prompt es una instrucción,
        similar a una pregunta o indicación que se le da a una herramienta para obtener un resultado.
    </p>

    <blockquote>
        "Un prompt es la forma en que nos comunicamos con la inteligencia artificial."
    </blockquote>

    <h4>2. Iniciar con ejemplos simples</h4>
    <p>
        El docente debe comenzar con ejemplos básicos, incluso incompletos, para que el estudiante entienda la lógica.
    </p>

    <pre>Ejemplo de prompt base: "Explica la inteligencia artificial"</pre>

    <p>
        En esta etapa no importa que el prompt sea imperfecto, lo importante es que el estudiante entienda que
        la IA responde a lo que se le pide.
    </p>

    <h4>3. Pedir observación del resultado</h4>
    <p>
        El docente debe fomentar el pensamiento crítico mediante preguntas estratégicas:
    </p>

    <ul style="margin-left: 25px; margin-bottom: 20px;">
        <li>¿El resultado fue claro y preciso?</li>
        <li>¿Qué información faltó en la respuesta?</li>
        <li>¿Qué palabras cambiarías para mejorar el resultado?</li>
    </ul>

    <h4>4. Introducir la mejora progresiva</h4>
    <p>
        Muestre cómo evolucionar una instrucción simple a una más funcional sin añadir complejidad técnica excesiva.
    </p>

    <pre>Mejora sugerida: "Genera un guion corto explicando qué es la inteligencia artificial para niños de 10 años"</pre>

    <h4>5. Errores que el docente debe evitar</h4>
    <div style="border: 2px solid #002244; padding: 20px; background: #f9f9f9;">
        <ul style="list-style-type: square; margin-left: 20px;">
            <li>Explicar tecnicismos de una sola vez.</li>
            <li>No analizar los resultados generados por la IA.</li>
            <li>Enfocarse solo en el video final y no en la instrucción escrita.</li>
            <li>Limitar la experimentación creativa del alumno.</li>
        </ul>
    </div>

</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

<?php include '../Api-key/modal-AI.php'; ?>
<script src="../js/Api.js"></script>

<script>
    // Gestión de estado activo en el menú
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