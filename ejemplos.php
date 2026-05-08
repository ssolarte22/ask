<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos - Tutor IA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1> Ejemplos de Prompts</h1>
    <p>Aprende a crear videos efectivos con inteligencia artificial</p>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>

    <h2> ¿Por qué son importantes los ejemplos?</h2>

    <p>
        Los ejemplos permiten comprender cómo estructurar correctamente un prompt y qué tipo de resultados se pueden obtener. 
        En esta sección encontrarás casos reales que puedes usar como referencia o adaptar según tu necesidad.
    </p>

</section>

<section>
    <h2>Bueno vs Malo - Prompt (Comparación directa)</h2>

    <table>
        <thead>
            <tr>
                <th>Tipo de prompt</th>
                <th>Prompt</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td> Malo</td>
                <td>Haz un video sobre tecnología</td>
                <td>Resultado genérico, sin enfoque claro</td>
            </tr>

            <tr>
                <td> Regular</td>
                <td>Explica la tecnología en un video</td>
                <td>Mejora, pero aún ambiguo</td>
            </tr>

            <tr>
                <td> Bueno</td>
                <td>
                    Genera un video educativo de 40 segundos explicando qué es la inteligencia artificial, 
                    con ejemplos simples, voz clara en español y tono académico.
                </td>
                <td>Contenido claro, estructurado y útil</td>
            </tr>

        </tbody>
    </table>

</section>

<section>

<h2> Ejemplos por tipo de uso</h2>

    <h3> 1. Video educativo</h3>

    <p><strong>Prompt:</strong></p>
    <p>
        Genera un video de 60 segundos explicando qué es una base de datos, 
        con ejemplos simples, lenguaje claro y tono educativo en español.
    </p>

    <p><strong>¿Por qué funciona?</strong></p>
    <ul>
        <li>Define duración</li>
        <li>Define tema</li>
        <li>Define estilo</li>
    </ul>

    <hr><br><br>

    <h3> 2. Contenido para redes sociales</h3>

    <p><strong>Prompt:</strong></p>
    <p>
        Crea un video corto de 20 segundos mostrando curiosidades sobre inteligencia artificial, 
        con tono dinámico y lenguaje juvenil.
    </p>

    <p><strong>¿Por qué funciona?</strong></p>
    <ul>
        <li>Duración corta</li>
        <li>Enfocado en entretenimiento</li>
        <li>Público específico</li>
    </ul>

    <hr><br><br>
    <h3> 3. Video profesional</h3>

    <p><strong>Prompt:</strong></p>
    <p>
        Genera un video corporativo de 45 segundos presentando un software de gestión empresarial, 
        con tono formal y lenguaje técnico.
    </p>

    <p><strong>¿Por qué funciona?</strong></p>
    <ul>
        <li>Define contexto profesional</li>
        <li>Lenguaje adecuado</li>
        <li>Objetivo claro</li>
    </ul>

</section>

<section>
    <h2> Plantillas de Prompts </h2>

<table>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Plantilla</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>Educativo</td>
            <td>
                Genera un video de [duración] explicando [tema] con ejemplos simples, en español y tono educativo.
            </td>
        </tr>

        <tr>
            <td>Redes</td>
            <td>
                Crea un video corto de [duración] sobre [tema], con estilo dinámico y lenguaje juvenil.
            </td>
        </tr>

        <tr>
            <td>Profesional</td>
            <td>
                Genera un video de [duración] presentando [producto/tema], con tono formal y lenguaje técnico.
            </td>
        </tr>

    </tbody>
</table>

</section>

<section>

    <h2> Errores comunes al crear prompts</h2>

    <ul style="text-align:left; margin-left:20px;">
        <li> No especificar duración</li>
        <li> No indicar el tipo de video</li>
        <li> Usar frases muy generales</li>
        <li> No definir el público</li>
        <li> Mezclar demasiadas ideas</li>
    </ul>

</section>

<section>

<h2> Prueba tú mismo</h2>

    <p>
        Ahora puedes aplicar lo aprendido generando tu propio video con la herramienta integrada.
    </p>

    <p>
        Te recomendamos copiar uno de los ejemplos y modificarlo según tu necesidad.
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