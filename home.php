<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Tutor IA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🎬</span>
        <div>
            <h1>Tutor para Creación de Videos con IA</h1>
            <p>Aprende a transformar ideas en contenido audiovisual</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>

    <h2> ¿Qué es esta plataforma?</h2>
    <p>
        Esta plataforma ha sido diseñada como un entorno educativo digital enfocado en el aprendizaje 
        del uso de inteligencia artificial para la creación de videos. Su propósito principal es permitir 
        que cualquier usuario, incluso sin experiencia previa, pueda generar contenido audiovisual mediante 
        el uso de instrucciones escritas conocidas como <strong>prompts</strong>.
    </p>

    <p>
        A través de este sistema, se busca no solo enseñar el uso de herramientas tecnológicas modernas, 
        sino también desarrollar habilidades como la redacción estructurada, el pensamiento lógico y la 
        creatividad digital. El usuario aprende a comunicarse con sistemas inteligentes de manera efectiva, 
        logrando resultados más precisos y de mayor calidad.
    </p>

</section>

<section>

    <h2> ¿Qué es la Inteligencia Artificial aplicada al video?</h2>

    <p>
        La inteligencia artificial aplicada a la generación de video consiste en el uso de modelos 
        computacionales capaces de interpretar texto, imágenes o instrucciones, y transformarlos 
        automáticamente en contenido audiovisual.
    </p>

    <p>
        Estas herramientas permiten generar videos con narración, animaciones o incluso avatares que 
        simulan ser personas reales. Esto representa un avance significativo en áreas como la educación, 
        el marketing, la comunicación digital y la producción multimedia.
    </p>

    <p>
        En lugar de grabar, editar y producir manualmente, el usuario solo necesita describir lo que desea, 
        y la inteligencia artificial se encarga del resto.
    </p>

</section>

<section>

    <h2> Ejemplos básicos de uso</h2>

    <table>
        <thead>
            <tr>
                <th>Situación</th>
                <th>Uso de IA</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Explicar un tema</td>
                <td>Escribir un prompt educativo</td>
                <td>Video con avatar explicando</td>
            </tr>
            <tr>
                <td>Crear contenido redes</td>
                <td>Prompt creativo</td>
                <td>Clip corto animado</td>
            </tr>
            <tr>
                <td>Presentación</td>
                <td>Texto estructurado</td>
                <td>Video narrado profesional</td>
            </tr>
        </tbody>
    </table>

</section>

<section>

    <h2> Ingeniería de Prompts</h2>

    <p>
        El prompt es la instrucción que se le proporciona a la inteligencia artificial. La calidad del 
        resultado depende directamente de qué tan claro, específico y estructurado sea este mensaje.
    </p>

    <p>
        Un prompt mal redactado genera resultados imprecisos o poco útiles, mientras que un prompt bien 
        definido permite obtener contenido claro, coherente y alineado con el objetivo del usuario.
    </p>

    <table>
        <thead>
            <tr>
                <th>Tipos de prompt</th>
                <th>Ejemplo</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Malo</td>
                <td>Haz un video sobre tecnología</td>
                <td>Contenido genérico y poco claro</td>
            </tr>
            <tr>
                <td>Regular</td>
                <td>Explica la tecnología en un video</td>
                <td>Mejor contexto pero ambiguo</td>
            </tr>
            <tr>
                <td>Bueno</td>
                <td>
                    Genera un video educativo de 40 segundos explicando qué es la inteligencia artificial, 
                    con ejemplos simples, lenguaje claro y tono académico en español.
                </td>
                <td>Resultado claro, estructurado y útil</td>
            </tr>
        </tbody>
    </table>

</section>

<section>

    <h2> ¿Cómo escribir un buen prompt?</h2>

    <table>
        <thead>
            <tr>
                <th>Elemento</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Objetivo</td>
                <td>Qué quieres que haga el video</td>
            </tr>
            <tr>
                <td>Duración</td>
                <td>Tiempo aproximado del contenido</td>
            </tr>
            <tr>
                <td>Estilo</td>
                <td>Formal, educativo, creativo</td>
            </tr>
            <tr>
                <td>Público</td>
                <td>A quién va dirigido</td>
            </tr>
            <tr>
                <td>Idioma</td>
                <td>Lenguaje del contenido</td>
            </tr>
        </tbody>
    </table>

</section>

<section>

    <h2>Empieza a crear tu video</h2>

    <p>
        Ahora que conoces los conceptos básicos, puedes comenzar a experimentar con la generación de videos. 
        Escribe un prompt claro y observa cómo la inteligencia artificial lo transforma en contenido audiovisual.
    </p>

    <p>
        Esta herramienta está diseñada para que aprendas practicando, por lo que se recomienda probar diferentes 
        tipos de instrucciones y analizar los resultados obtenidos.
    </p>

    <br>

</section>

<footer>
    <p>© 2025 Tutor IA - Colegio Mayor del Cauca</p>
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