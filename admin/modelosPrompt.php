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
    <title>Modelos de Prompts - Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .formula-box { background-color: #121212; color: #D4AF37; padding: 20px; font-family: 'Courier New', Courier, monospace; font-weight: bold; font-size: 1.2rem; border-left: 10px solid #002244; margin: 15px 0; text-align: center; letter-spacing: 2px; }
        pre { background: #f4f4f4; color: #121212; padding: 15px; border: 1px solid #121212; margin-bottom: 20px; }
        .check-list { list-style: none; padding: 0; }
        .check-list li::before { content: "▪ "; color: #D4AF37; font-weight: bold; }
        .badge-profe { background: #D4AF37; color: #121212; padding: 4px 12px; font-weight: bold; text-transform: uppercase; font-size: 0.8rem; display: inline-block; margin-top: 10px; }
        .comparativo-table th { background-color: #002244; color: #D4AF37; }
    </style>
</head>
<body>

<?php include 'top_admin.php'; ?>

<section>
    <h2>Modelos de construcción de prompts</h2>
    <p>Este módulo proporciona estructuras lógicas que el administrador puede revisar como referencia del contenido del sistema.</p>

    <div class="tarjeta">
        <h3>Modelo 1: Prompt Básico</h3>
        <p>Es el punto de entrada. Ideal para que el estudiante pierda el miedo a la herramienta.</p>
        <div class="formula-box">[ACCIÓN] + [TEMA]</div>
        <p><strong>Ejemplo práctico:</strong></p>
        <pre>Explica la inteligencia artificial</pre>
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
        <div class="formula-box" style="font-size: 0.95rem;">[ACCIÓN] + [DURACIÓN] + [TEMA] + [OBJETIVO] + [ESTILO] + [PÚBLICO]</div>
        <p><strong>Ejemplo práctico:</strong></p>
        <pre>Genera un video educativo de 40 segundos explicando la inteligencia artificial, con ejemplos cotidianos, lenguaje claro y dirigido a estudiantes universitarios.</pre>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

</body>
</html>
