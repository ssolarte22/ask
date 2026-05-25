<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Tutor IA Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Preguntas Frecuentes</h1>
            <p>Guía de uso y resolución de problemas técnicos</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <h2>Sobre la Plataforma</h2>
    <div class="faq-grid">
        <div class="pregunta-card">
            <span class="status-badge">GENERAL</span>
            <h3>¿Cuál es el objetivo del Tutor IA?</h3>
            <p>Facilitar el aprendizaje de herramientas de IA para generar videos a partir de texto, permitiendo a docentes y estudiantes crear contenido sin conocimientos técnicos avanzados.</p>
        </div>
        <div class="pregunta-card">
            <span class="status-badge">REQUISITOS</span>
            <h3>¿Necesito experiencia previa?</h3>
            <p>No. El sistema está diseñado para usuarios principiantes, proporcionando ejemplos estructurados y guías paso a paso.</p>
        </div>
    </div>

    <hr style="margin: 30px 0;">

    <h2>Prompts y Generación (Ingeniería de Instrucciones)</h2>
    <p>El prompt es el elemento clave. Un buen prompt mejora exponencialmente la calidad del video.</p>
    
    <table>
        <thead>
            <tr>
                <th>Duda Común</th>
                <th>Explicación Técnica</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>¿Por qué mi video no es claro?</strong></td>
                <td>Generalmente ocurre porque el prompt es ambiguo. La IA requiere detalles sobre estilo, tono y objetivo.</td>
            </tr>
            <tr>
                <td><strong>¿Cómo optimizar un prompt?</strong></td>
                <td>Debe incluir obligatoriamente: Objetivo, Duración, Estilo, Idioma y Público Objetivo.</td>
            </tr>
            <tr>
                <td><strong>¿Cuánto tarda el proceso?</strong></td>
                <td>Dependiendo de la API y la complejidad, puede tardar desde 30 segundos hasta 3 minutos.</td>
            </tr>
        </tbody>
    </table>

    <hr style="margin: 30px 0;">

    <h2>Resolución de Errores Comunes</h2>
    <table>
        <thead>
            <tr>
                <th>Problema Detectado</th>
                <th>Causa Probable</th>
                <th>Acción Recomendada</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Error de Generación / Timeout</td>
                <td>Saturación en la API o caída de red.</td>
                <td>Verificar conexión e intentar de nuevo en 1 minuto.</td>
            </tr>
            <tr>
                <td>Respuesta JSON Inválida</td>
                <td>Conflicto en la ruta del backend.</td>
                <td>Contactar a soporte técnico de Unimayor para revisión de rutas.</td>
            </tr>
            <tr>
                <td>Créditos Insuficientes</td>
                <td>Límite alcanzado en el plan gratuito.</td>
                <td>Esperar al ciclo de renovación o utilizar una API alternativa.</td>
            </tr>
        </tbody>
    </table>

    <div class="tarjeta dark" style="margin-top: 40px;">
        <h3>Consejos para el Éxito</h3>
        <ul class="check-list">
            <li><strong>Especificidad:</strong> Menos es más, siempre que sea claro.</li>
            <li><strong>Iteración:</strong> Prueba diferentes versiones del mismo prompt.</li>
            <li><strong>Análisis:</strong> Observa qué palabras clave generan mejores visuales.</li>
        </ul>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <p>¿Aún tienes dudas? Consulta la sección de <strong>Misión</strong> para entender el alcance pedagógico.</p>
        <br>
        <a href="mision.php" class="btn">Ver Misión del Proyecto</a>
    </div>
</section>

<footer>
    <p>© 2026 Tutor IA - Colegio Mayor del Cauca</p>
    <p>📍 Popayán, Cauca | Centro de Innovación Educativa</p>
</footer>

<script>
    const links = document.querySelectorAll("nav a");
    const current = window.location.pathname.split("/").pop();

    links.forEach(link => {
        if (link.getAttribute("href") === current) {
            link.classList.add("active");
        }
    });
</script>

</body>
</html>