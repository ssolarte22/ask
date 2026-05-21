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
    <title>Panel Administrador - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .welcome-box { background: #D4AF37; color: #121212; padding: 8px 15px; display: inline-block; font-weight: bold; text-transform: uppercase; font-size: 0.85rem; margin-top: 10px; border: 1px solid #121212; }
        .grid-objetivos { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 25px 0; }
        .objetivo-item { background: #fff; border: 2px solid #002244; padding: 15px; border-left: 8px solid #D4AF37; }
        .check-list { list-style: none; padding: 0; }
        .check-list li::before { content: "▪ "; color: #D4AF37; font-weight: bold; }
        table { border: 2px solid #121212; }
        th { background-color: #002244; color: #D4AF37; }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Plataforma Administrador - Videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
            <div class="welcome-box">
                Bienvenido Administrador: <?php echo htmlspecialchars($_SESSION['docente'] ?? ($_SESSION['usuario'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    </div>
</header>

<nav>
    <?php include 'menuAdmin.html'; ?>
</nav>

<section>
    <h2>Guía administrativa para el uso de IA en la creación de videos</h2>
    <p>
        Este espacio administrativo permite revisar el sistema, supervisar el contenido y administrar la plataforma.
    </p>

    <div class="tarjeta">
        <h3>Propósito Administrativo</h3>
        <p>
            El objetivo no es solo operar la plataforma, sino controlar su funcionamiento, revisar contenidos y mantener el sistema ordenado.
        </p>
    </div>

    <h3>Objetivos Estratégicos</h3>
    <div class="grid-objetivos">
        <div class="objetivo-item">Supervisar accesos y funcionamiento del sistema.</div>
        <div class="objetivo-item">Revisar cursos y contenido disponible.</div>
        <div class="objetivo-item">Mantener actualizada la información del perfil.</div>
        <div class="objetivo-item">Acompañar la gestión de la plataforma.</div>
    </div>

    <h3>Flujo de Trabajo Recomendado</h3>
    <table>
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Descripción</th>
                <th>Rol Admin</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><strong>Exploración</strong></td><td>Conocimiento de la interfaz y herramientas.</td><td>Facilitador técnico</td></tr>
            <tr><td><strong>Gestión</strong></td><td>Administración de datos y usuarios.</td><td>Supervisor de contenido</td></tr>
            <tr><td><strong>Control</strong></td><td>Validación de cambios y funcionamiento.</td><td>Administrador del sistema</td></tr>
            <tr><td><strong>Seguimiento</strong></td><td>Revisión del uso y ajustes necesarios.</td><td>Coordinador</td></tr>
        </tbody>
    </table>

    <div style="display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px; border: 2px solid #881111; padding: 20px; background: #fffcfc;">
            <h3 style="color: #881111; border-left-color: #881111;">Problemas Comunes</h3>
            <ul class="check-list">
                <li>Errores de acceso o sesión.</li>
                <li>Usuarios con datos incorrectos.</li>
                <li>Información de cursos desactualizada.</li>
                <li>Falta de control en la plataforma.</li>
            </ul>
        </div>

        <div style="flex: 1; min-width: 300px; border: 2px solid #002244; padding: 20px; background: #fcfdff;">
            <h3 style="color: #002244;">Recomendaciones Clave</h3>
            <ul class="check-list">
                <li>Verificar usuarios y contraseñas en la base de datos.</li>
                <li>Mantener actualizada la información de perfil.</li>
                <li>Revisar el contenido antes de publicarlo.</li>
                <li>Usar la plataforma de manera ordenada.</li>
            </ul>
        </div>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

</body>
</html>
