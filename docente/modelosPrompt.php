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
    <title>Modelos de Prompts - Colegio Mayor</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilos para las formulas de prompts */
        .formula-box {
            background-color: #121212;
            color: #D4AF37;
            padding: 20px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: 1.2rem;
            border-left: 10px solid #002244;
            margin: 15px 0;
            text-align: center;
            letter-spacing: 2px;
        }
        
        pre {
            background: #f4f4f4;
            color: #121212;
            padding: 15px;
            border: 1px solid #121212;
            margin-bottom: 20px;
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

        .badge-profe {
            background: #D4AF37;
            color: #121212;
            padding: 4px 12px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 10px;
        }

        .comparativo-table th {
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
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div class="badge-profe">
                Usuario: <?php echo htmlspecialchars($_SESSION['docente']); ?>
            </div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuDocente.html'; ?>
</nav>

<section>
    <h2>Modelos de construcción de prompts</h2>

    <p>
        Este módulo proporciona estructuras lógicas que el docente puede utilizar como guía para enseñar 
        la creación de prompts de forma organizada, técnica y progresiva.
    </p>

    <hr style="border: 1px solid #ddd; margin: 30px 0;">

    <div class="tarjeta">
        <h3>Modelo 1: Prompt Básico</h3>
        <p>Es el punto de entrada. Ideal para que el estudiante pierda el miedo a la herramienta.</p>
        <div class="formula-box">[ACCIÓN] + [TEMA]</div>
        <p><strong>Ejemplo práctico:</strong></p>
        <pre>Explica la inteligencia artificial</pre>
        <p style="font-size: 0.9rem; color: #666;"><em>Nota: Genera resultados generales y poco personalizados.</em></p>
    </div>

    <div class="tarjeta" style="margin-top: 40px;">
        <h3>Modelo 2: Prompt Estructurado</h3>
        <p>Añade una capa de intención para que la IA entienda el "para qué" de la instrucción.</p>
        <div class="formula-box">[ACCIÓN] + [TEMA] + [OBJETIVO]</div>
        <p><strong>Ejemplo práctico:</strong></p>
        <pre>Explica la inteligencia artificial para estudiantes de primaria</pre>
    </div>

    <div class="tarjeta" style="margin-top: 40px; border-color: #D4AF37;">
        <h3>Modelo 3: Prompt Completo (Nivel Profesional)</h3>
        <p>Incluye todas las variables necesarias para una producción audiovisual de alta calidad.</p>
        <div class="formula-box" style="font-size: 0.95rem;">
            [ACCIÓN] + [DURACIÓN] + [TEMA] + [OBJETIVO] + [ESTILO] + [PÚBLICO]
        </div>
        <p><strong>Ejemplo práctico:</strong></p>
        <pre>Genera un video educativo de 40 segundos explicando la inteligencia artificial, con ejemplos cotidianos, lenguaje claro y dirigido a estudiantes universitarios.</pre>
    </div>

    <h3>Análisis Comparativo</h3>
    <table class="comparativo-table">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Complejidad Técnica</th>
                <th>Calidad del Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Básico</strong></td>
                <td>Baja</td>
                <td>Baja (General)</td>
            </tr>
            <tr>
                <td><strong>Estructurado</strong></td>
                <td>Media</td>
                <td>Media (Contextualizado)</td>
            </tr>
            <tr>
                <td><strong>Completo</strong></td>
                <td>Alta</td>
                <td>Alta (Profesional)</td>
            </tr>
        </tbody>
    </table>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 40px;">
        <div style="border: 2px solid #002244; padding: 20px;">
            <h3 style="color: #002244;">Buenas Prácticas</h3>
            <ul class="check-list">
                <li>Ser específico en los detalles técnicos.</li>
                <li>Definir siempre el público objetivo.</li>
                <li>Usar verbos de acción claros (Genera, Crea, Explica).</li>
                <li>Mantener una estructura lógica.</li>
            </ul>
        </div>
        <div style="border: 2px solid #881111; padding: 20px;">
            <h3 style="color: #881111; border-left-color: #881111;">Malas Prácticas</h3>
            <ul class="check-list">
                <li>Escribir instrucciones vagas o cortas.</li>
                <li>Omitir el contexto pedagógico.</li>
                <li>Asumir que la IA conoce la duración deseada.</li>
                <li>No revisar el resultado final.</li>
            </ul>
        </div>
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