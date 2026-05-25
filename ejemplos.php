<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos de Prompts - Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Ejemplos de Prompts</h1>
            <p>Aprende a estructurar instrucciones efectivas para IA</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <h2>¿Por qué son importantes los ejemplos?</h2>
    <p>
        Los ejemplos permiten comprender la estructura lógica detrás de una instrucción exitosa. 
        En esta sección comparamos casos reales para que logres resultados precisos en tus videos educativos.
    </p>

    <hr style="margin: 40px 0;">

    <h2>Análisis Comparativo: Calidad del Prompt</h2>
    <table>
        <thead>
            <tr>
                <th>Nivel</th>
                <th>Estructura del Prompt</th>
                <th>Resultado Esperado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="color: #991b1b; font-weight: bold;">Malo</td>
                <td>"Haz un video sobre tecnología"</td>
                <td>Contenido genérico, visualmente inconsistente y sin enfoque educativo.</td>
            </tr>
            <tr>
                <td style="color: #1d4ed8; font-weight: bold;">Bueno</td>
                <td>"Genera un video educativo de 40 segundos explicando qué es la inteligencia artificial, con ejemplos simples, voz clara en español y tono académico."</td>
                <td>Material estructurado, con objetivos de aprendizaje claros y útil para el aula.</td>
            </tr>
        </tbody>
    </table>

    <hr style="margin: 40px 0;">

    <h2>Ejemplos por Categoría de Uso</h2>

    <div class="tarjeta">
        <h3>1. Video Educativo Metodológico</h3>
        <div class="prompt-container">
            <div class="prompt-header header-bueno">Estructura Recomendada</div>
            <div class="prompt-body">
                "Genera un video de 60 segundos explicando qué es una base de datos, con ejemplos simples, lenguaje claro y tono educativo en español."
            </div>
            <div class="analisis-box">
                <strong>¿Por qué funciona?:</strong> Define duración exacta, tema delimitado y estilo comunicativo.
            </div>
        </div>
    </div>

    <div class="tarjeta" style="margin-top: 30px;">
        <h3>2. Contenido de Divulgación Dinámica</h3>
        <div class="prompt-container">
            <div class="prompt-header header-bueno">Estructura Recomendada</div>
            <div class="prompt-body">
                "Crea un video corto de 20 segundos mostrando curiosidades sobre inteligencia artificial, con tono dinámico y lenguaje juvenil."
            </div>
            <div class="analisis-box">
                <strong>¿Por qué funciona?:</strong> Enfocado en micro-aprendizaje y retención para un público específico.
            </div>
        </div>
    </div>

    <hr style="margin: 40px 0;">

    <h2>Plantillas de Construcción Rápidas</h2>
    <p>Copia y adapta estas estructuras según tu asignatura:</p>
    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Plantilla (Completa los campos)</th>
            </tr>
                    <div class="tarjeta dark">
        <tbody>
            <tr>
                <td><strong>Académico</strong></td>
                <td>"Genera un video de [duración] explicando [tema] con ejemplos simples, en español y tono educativo."</td>
            </tr>
            <tr>
                <td><strong>Profesional</strong></td>
                <td>"Genera un video de [duración] presentando [producto/tema], con tono formal y lenguaje técnico."</td>
            </tr>
        </tbody>
    </table>

    <hr style="margin: 40px 0;">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        <div class="tarjeta">
            <h3>Errores Críticos a Evitar</h3>
            <ul class="check-list">
                <li>No especificar la duración del video.</li>
                <li>Omitir el tipo de audiencia o público.</li>
                <li>Usar frases excesivamente generales o ambiguas.</li>
                <li>Mezclar múltiples ideas en un solo clip corto.</li>
            </ul>
        </div>
        <div class="dark-panel" style="margin-top: 0;">
            <h3>Ponlo en Práctica</h3>
            <p>Aplica estas estructuras generando tu propio contenido con la herramienta integrada en la plataforma.</p>
            <p><em>Sugerencia: Copia la plantilla "Académica" y adáptala a tu próximo examen o taller.</em></p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Tutor IA - Colegio Mayor del Cauca</p>
    <p>📍 Popayán, Cauca | Innovación y Tecnología</p>
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