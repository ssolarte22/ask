<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Tutor IA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1> Preguntas Frecuentes</h1>
    <p>Guía completa para el uso de la plataforma y la generación de videos con IA</p>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>

    <h2> Sobre la Plataforma</h2>

    <p>
        Esta sección responde las dudas más comunes sobre el funcionamiento general del sistema.
    </p>

    <table>
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
    </thead>
    <tbody>

        <tr>
            <td>¿Cuál es el objetivo de esta plataforma?</td>
            <td>
                Permitir a los usuarios aprender y aplicar el uso de inteligencia artificial para la generación 
                de videos a partir de texto, facilitando la creación de contenido sin conocimientos técnicos avanzados.
            </td>
        </tr>

        <tr>
            <td>¿Necesito experiencia previa?</td>
            <td>
                No. La plataforma está diseñada para usuarios principiantes, proporcionando ejemplos y guías para aprender progresivamente.
            </td>
        </tr>

        <tr>
            <td>¿Puedo usarla con fines académicos?</td>
            <td>
                Sí, es especialmente útil para presentaciones, explicaciones de temas y proyectos educativos.
            </td>
        </tr>

        </tbody>
    </table>

    </section>

    <section>

        <h2> Uso de la Inteligencia Artificial</h2>

        <p>
            Aquí se explican aspectos clave sobre cómo interactuar con la IA.
        </p>

    <table>
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>¿Cómo funciona la generación de video?</td>
                <td>
                    La IA interpreta el texto ingresado (prompt) y genera automáticamente un video con voz, imagen o animación según la herramienta utilizada.
                </td>
            </tr>

            <tr>
                <td>¿Cuánto tarda en generarse un video?</td>
                <td>
                    Puede tardar entre unos segundos y varios minutos dependiendo del servicio y la complejidad del prompt.
                </td>
            </tr>

            <tr>
                <td>¿Puedo generar varios videos seguidos?</td>
                <td>
                    Sí, pero estás limitado por los créditos disponibles en la API utilizada.
                </td>
            </tr>

        </tbody>
    </table>

    </section>

    <section>

        <h2> Prompts (Lo más importante)</h2>

        <p>
            El prompt es el elemento clave del sistema. Un buen prompt mejora significativamente la calidad del resultado.
        </p>

    <table>
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>¿Qué es un prompt?</td>
                <td>
                    Es una instrucción detallada que describe lo que deseas que la inteligencia artificial genere.
                </td>
            </tr>

            <tr>
                <td>¿Por qué mi video no es claro?</td>
                <td>
                    Generalmente ocurre porque el prompt es muy corto, ambiguo o no especifica detalles importantes.
                </td>
            </tr>

            <tr>
                <td>¿Cómo mejorar un prompt?</td>
                <td>
                    Incluye objetivo, duración, estilo, idioma y público. Entre más específico, mejor resultado obtendrás.
                </td>
            </tr>

            <tr>
                <td>¿Es mejor escribir mucho texto?</td>
                <td>
                    No necesariamente más largo, sino más claro y estructurado.
                </td>
            </tr>

        </tbody>
    </table>

    </section>

    <section>

    <h2> Errores y Problemas Comunes</h2>

    <table>
        <thead>
            <tr>
                <th>Problema</th>
                <th>Posible causa</th>
                <th>Solución</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>No se genera el video</td>
                <td>Error en la API o conexión</td>
                <td>Reintentar o verificar conexión a internet</td>
            </tr>

            <tr>
                <td>Respuesta vacía</td>
                <td>Prompt no enviado correctamente</td>
                <td>Revisar que el campo no esté vacío</td>
            </tr>

            <tr>
                <td>Error JSON</td>
                <td>Ruta incorrecta o error en backend</td>
                <td>Verificar archivo PHP y rutas</td>
            </tr>

            <tr>
                <td>Video no carga</td>
                <td>Aún se está generando</td>
                <td>Esperar o actualizar estado</td>
            </tr>

        </tbody>
    </table>

    </section>

    <section>

    <h2> Créditos y Limitaciones</h2>

        <p>
            Las herramientas de IA suelen tener limitaciones en su versión gratuita.
        </p>

    <table>
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>¿La plataforma es gratuita?</td>
                <td>
                    El acceso es gratuito, pero la generación de videos depende de créditos proporcionados por la API.
                </td>
            </tr>

            <tr>
                <td>¿Qué pasa si se acaban los créditos?</td>
                <td>
                    No podrás generar más videos hasta recargar o usar otra API.
                </td>
            </tr>

            <tr>
                <td>¿Los videos tienen límite de duración?</td>
                <td>
                    Sí, normalmente los planes gratuitos limitan la duración del video generado.
                </td>
            </tr>

        </tbody>
    </table>

    </section>

    <section>

    <h2> Consejos para mejores resultados</h2>

    <ul style="text-align:left; margin-left: 20px;">
        <li>✔ Escribe prompts claros y específicos</li>
        <li>✔ Define el objetivo del video</li>
        <li>✔ Usa lenguaje simple</li>
        <li>✔ Prueba diferentes versiones del prompt</li>
        <li>✔ Analiza los resultados y mejora</li>
    </ul>
    </section>

    <section>
    <h2> Recomendación Final</h2>

    <p>
    La mejor forma de aprender a usar inteligencia artificial es mediante la práctica. Experimenta con distintos prompts, 
    analiza los resultados y mejora progresivamente tus instrucciones.
    </p>

    <p>
    La calidad del video no depende únicamente de la herramienta, sino de la forma en que el usuario se comunica con la IA.
    </p>

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