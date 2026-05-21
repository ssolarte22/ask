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
    <title>Formación Administrador - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table { border: 2px solid #121212; margin: 25px 0; }
        th { background-color: #002244; color: #D4AF37; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; }
        td { border: 1px solid #121212; padding: 15px; }
        .fase-badge { background-color: #121212; color: #FFFFFF; padding: 2px 8px; font-weight: bold; font-size: 0.8rem; display: inline-block; }
        blockquote { background: #f9f9f9; border-left: 10px solid #002244; padding: 20px; margin: 20px 0; border-right: 2px solid #121212; border-bottom: 2px solid #121212; }
        .check-list { list-style: none; padding-left: 0; }
        .check-list li::before { content: "▪"; color: #D4AF37; font-weight: bold; display: inline-block; width: 1em; margin-left: 0; }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creación de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div style="background: #D4AF37; color: #121212; padding: 3px 10px; display: inline-block; font-weight: bold; font-size: 0.8rem; margin-top: 10px;">
                ADMINISTRADOR: <?php echo htmlspecialchars($_SESSION['usuario'] ?? ($_SESSION['docente'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuAdmin.html'; ?>
</nav>

<section>
    <h2>Formación Técnica en IA para la Administración de la Plataforma</h2>
    <p>Este módulo ayuda al administrador a comprender el flujo interno de la plataforma y su operación general.</p>

    <div class="tarjeta">
        <h3>¿Cómo interpreta la plataforma la información?</h3>
        <p>La plataforma procesa los datos de sesión, usuarios y contenido mediante consultas a la base de datos.</p>
        <ul class="check-list">
            <li>Validación de credenciales</li>
            <li>Consulta de usuarios activos</li>
            <li>Actualización de perfiles</li>
        </ul>
    </div>

    <h3>Flujo interno de procesamiento</h3>
    <table>
        <thead><tr><th>Fase</th><th>Operación</th></tr></thead>
        <tbody>
            <tr><td><span class="fase-badge">01</span> ENTRADA</td><td>Recepción de datos de usuario y sesión.</td></tr>
            <tr><td><span class="fase-badge">02</span> CONTROL</td><td>Verificación de rol y permisos.</td></tr>
            <tr><td><span class="fase-badge">03</span> GESTIÓN</td><td>Actualización de información en la base de datos.</td></tr>
        </tbody>
    </table>

    <h3>Variables Críticas de Éxito</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0;">
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;"><strong>1. Claridad:</strong> Evitar datos inconsistentes.</div>
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;"><strong>2. Especificidad:</strong> Definir bien cada usuario.</div>
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;"><strong>3. Contexto:</strong> Mantener el control de acceso.</div>
        <div style="border: 1px solid #121212; padding: 15px; background: #fff;"><strong>4. Formato:</strong> Registrar cambios correctamente.</div>
    </div>

    <h3>Ejemplo de Evolución Técnica</h3>
    <blockquote>
        <p><strong>Acceso Base:</strong> “Ingresar con usuario y contraseña”</p>
        <p style="color: #004400; font-size: 0.9rem;"><em>Estado: Correcto (validado en base de datos)</em></p>
    </blockquote>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

</body>
</html>
