<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Tutor IA Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor IA: Producción Audiovisual</h1>
            <p>Institución Universitaria Colegio Mayor del Cauca</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<div class="hero-banner">
    <h2>Transforma tus ideas en contenido visual</h2>
    <p>Entorno educativo digital para el aprendizaje y creación de videos con Inteligencia Artificial.</p>
    <br>
    <a href="verificacion.php" class="btn">Comenzar ahora</a>
    <a href="registrar.php" class="btn">Registrar profesor</a>
    <a href="admin/login.php" class="btn">Administrador</a>
</div>

<section>
    <h2>¿Qué es esta plataforma?</h2>
    <p>
        Este sistema ha sido diseñado para que cualquier docente o estudiante pueda generar contenido audiovisual mediante 
        instrucciones escritas conocidas como <strong>prompts</strong>. Buscamos desarrollar habilidades de redacción estructurada 
        y pensamiento lógico aplicadas a la tecnología moderna.
    </p>

    <div class="feature-grid">
        <div class="tarjeta">
            <h3>IA aplicada al Video</h3>
            <p>Uso de modelos computacionales que interpretan texto y lo transforman automáticamente en narrativa visual, avatares y animaciones.</p>
        </div>
        <div class="tarjeta">
            <h3>Ingeniería de Prompts</h3>
            <p>La calidad del video depende de la claridad y estructura del mensaje. Aprende a comunicarte de forma efectiva con sistemas inteligentes.</p>
        </div>
    </div>

    <hr style="margin: 40px 0;">

    <h2>Guía de Construcción de Prompts</h2>
    <p>Un buen prompt debe ser específico. Compare estos tres niveles de ejecución:</p>

    <div class="feature-grid">
        <div class="step-card">
            <span class="badge-status" style="background: #fee2e2; color: #991b1b;">Nivel: Ineficiente</span>
            <h4>Prompt Básico</h4>
            <div class="prompt-preview">"Haz un video sobre tecnología"</div>
            <p><small>Resultado: Contenido genérico, visualmente inconsistente y sin enfoque claro.</small></p>
        </div>

        <div class="step-card">
            <span class="badge-status" style="background: #fef9c3; color: #854d0e;">Nivel: Intermedio</span>
            <h4>Prompt Estructurado</h4>
            <div class="prompt-preview">"Explica la tecnología en un video educativo para estudiantes."</div>
            <p><small>Resultado: Mejora el contexto, pero sigue siendo ambiguo para la IA.</small></p>
        </div>

        <div class="step-card">
            <span class="badge-status" style="background: #dcfce7; color: #166534;">Nivel: Profesional</span>
            <h4>Prompt Completo</h4>
            <div class="prompt-preview">"Genera un video educativo de 40 segundos sobre IA, con ejemplos simples y tono académico en español."</div>
            <p><small>Resultado: Contenido claro, estructurado y listo para uso pedagógico.</small></p>
        </div>
    </div>

    <h3>Elementos Esenciales</h3>
    <table>
        <thead>
            <tr>
                <th>Componente</th>
                <th>Descripción Técnica</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Objetivo</strong></td>
                <td>Define la acción principal del video.</td>
            </tr>
            <tr>
                <td><strong>Duración</strong></td>
                <td>Tiempo exacto o aproximado en segundos.</td>
            </tr>
            <tr>
                <td><strong>Público</strong></td>
                <td>A quién va dirigido el mensaje (Estudiantes, Profesionales, etc).</td>
            </tr>
            <tr>
                <td><strong>Idioma</strong></td>
                <td>Configuración del lenguaje y acento de la narración.</td>
            </tr>
        </tbody>
    </table>

    <div class="tarjeta dark">
        <h2>¿Listo para practicar?</h2>
        <p>Escribe tu primera instrucción y observa cómo la IA la transforma en contenido audiovisual real.</p>
        <br>
        <a href="catalogo.php" class="btn">Explorar Catálogo de IA</a>
    </div>
</section>

<footer>
    <p>© 2026 Tutor IA - Colegio Mayor del Cauca</p>
    <p>📍 Calle 5 # 8-20, Popayán | Innovación y Excelencia</p>
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