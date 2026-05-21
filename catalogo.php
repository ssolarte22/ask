<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de IA - Unimayor</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos para tablas de comparación técnica */
        table {
            border: 2px solid #121212;
            margin-bottom: 40px;
        }
        th {
            background-color: #002244;
            color: #D4AF37;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 12px;
        }
        td {
            border: 1px solid #eee;
            padding: 12px;
            font-size: 0.95rem;
        }
        tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        .prompt-code {
            background-color: #121212;
            color: #D4AF37;
            padding: 5px 10px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            display: block;
        }
        .tag-gratis {
            background: #dcfce7;
            color: #166534;
            padding: 2px 8px;
            font-weight: bold;
            font-size: 0.75rem;
        }
        .tag-pago {
            background: #fee2e2;
            color: #991b1b;
            padding: 2px 8px;
            font-weight: bold;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Catálogo de Herramientas IA</h1>
            <p>Explora, compara y optimiza generadores de video</p>
        </div>
    </div>
</header>

<nav>
    <?php include 'menu.html'; ?>
</nav>

<section>
    <h2>Catálogo de Inteligencias Artificiales para Video</h2>

    <p>
        Este catálogo presenta las principales herramientas de inteligencia artificial utilizadas para la generación 
        de contenido audiovisual. Cada herramienta tiene características específicas que determinan su uso según 
        el contexto, la complejidad del proyecto y el nivel técnico del usuario.
    </p>

    <div class="tarjeta" style="margin: 30px 0; border-left: 8px solid #D4AF37;">
        <h3>Comparación General de Motores</h3>
        <table>
            <thead>
                <tr>
                    <th>IA</th>
                    <th>Tipo de Video</th>
                    <th>Dificultad</th>
                    <th>Acceso</th>
                    <th>Uso Recomendado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>D-ID</strong></td>
                    <td>Avatar con voz</td>
                    <td>Baja</td>
                    <td><span class="tag-gratis">Parcial</span></td>
                    <td>Explicaciones educativas</td>
                </tr>
                <tr>
                    <td><strong>Runway ML</strong></td>
                    <td>Cinematográfico</td>
                    <td>Alta</td>
                    <td><span class="tag-gratis">Parcial</span></td>
                    <td>Producción avanzada</td>
                </tr>
                <tr>
                    <td><strong>Pika Labs</strong></td>
                    <td>Clips animados</td>
                    <td>Baja</td>
                    <td><span class="tag-gratis">Gratis</span></td>
                    <td>Redes sociales</td>
                </tr>
                <tr>
                    <td><strong>HeyGen</strong></td>
                    <td>Avatar corporativo</td>
                    <td>Media</td>
                    <td><span class="tag-gratis">Parcial</span></td>
                    <td>Marketing / Presentaciones</td>
                </tr>
                <tr>
                    <td><strong>Synthesia</strong></td>
                    <td>Presentador IA</td>
                    <td>Media</td>
                    <td><span class="tag-pago">Pago</span></td>
                    <td>Capacitación empresarial</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3>Nivel Técnico y Curva de Aprendizaje</h3>
    <table>
        <thead>
            <tr>
                <th>Herramienta</th>
                <th>Programación</th>
                <th>Uso de API</th>
                <th>Curva de Aprendizaje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D-ID</td>
                <td>No</td>
                <td>Sí</td>
                <td>Baja</td>
            </tr>
            <tr>
                <td>Runway ML</td>
                <td>Opcional</td>
                <td>Sí</td>
                <td>Alta</td>
            </tr>
            <tr>
                <td>Pika Labs</td>
                <td>No</td>
                <td>No</td>
                <td>Baja</td>
            </tr>
            <tr>
                <td>HeyGen</td>
                <td>No</td>
                <td>Opcional</td>
                <td>Media</td>
            </tr>
        </tbody>
    </table>

    <h3>Modelos de Prompts por Plataforma</h3>
    <p>Utilice estos esquemas para maximizar la calidad en cada herramienta:</p>
    
    <div class="tarjeta">
        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 15px;">
                <strong>D-ID:</strong> 
                <span class="prompt-code">Explica qué es la inteligencia artificial en 30 segundos con tono educativo.</span>
            </li>
            <li style="margin-bottom: 15px;">
                <strong>Pika Labs:</strong> 
                <span class="prompt-code">Un robot caminando en una ciudad futurista con luces neón, estilo Pixar.</span>
            </li>
            <li style="margin-bottom: 15px;">
                <strong>Runway ML:</strong> 
                <span class="prompt-code">Cinematographic wide shot, astronaut on Mars, realistic textures, 4k.</span>
            </li>
        </ul>
    </div>

    <div class="dark-panel">
        <h3>Prueba la IA Integrada</h3>
        <p>
            Puede probar directamente la generación de video usando la herramienta integrada en nuestra plataforma. 
            Aplique los modelos de prompts analizados para obtener resultados óptimos.
        </p>
        <br>
        <a href="verificacion.php" class="btn">Comenzar Prueba Real</a>
    </div>

</section>

<footer>
    <p>© 2026 Tutor IA - Colegio Mayor del Cauca</p>
    <p>📍 Calle 5 # 8-20, Popayán | Innovación Pedagógica</p>
</footer>

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