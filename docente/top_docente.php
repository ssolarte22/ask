<?php
$docentePagina = basename($_SERVER['PHP_SELF'] ?? '');

if (!isset($tituloPlataforma)) {
    $tituloPlataforma = 'Plataforma Docente - Videos con IA';
}

if (!isset($subtituloPlataforma)) {
    $subtitulos = [
        'homeDocente.php' => 'Mira tus cursos y actividades',
        'perfil.php' => 'Revisa y actualiza tu perfil',
        'formacion.php' => 'Explora la formación técnica',
        'modelosPrompt.php' => 'Consulta modelos para crear prompts',
        'curso1.php' => 'Mira tu curso uno',
        'curso2.php' => 'Mira tu curso dos',
        'cursos.php' => 'Crea y administra tus cursos',
        'estudiantes.php' => 'Registra y asigna estudiantes',
        'curso_detalle.php' => 'Revisa el detalle del curso',
        'cerrarSession.php' => 'Cierre seguro de sesión',
    ];

    $subtituloPlataforma = $subtitulos[$docentePagina] ?? 'Gestiona tu espacio docente';
}

if (!isset($badgePlataforma)) {
    $badgePlataforma = 'Bienvenido Profesor: ' . ($_SESSION['docente'] ?? '');
}
?>
<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1><?php echo htmlspecialchars($tituloPlataforma, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p><?php echo htmlspecialchars($subtituloPlataforma, ENT_QUOTES, 'UTF-8'); ?></p>
            <div class="welcome-box">
                <?php echo htmlspecialchars($badgePlataforma, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    </div>
</header>

<nav>
    <?php include __DIR__ . '/menuDocente.html'; ?>
</nav>

<?php include __DIR__ . '/../Api-key/modal-AI.php'; ?>
<script src="/ask/js/Api.js"></script>
