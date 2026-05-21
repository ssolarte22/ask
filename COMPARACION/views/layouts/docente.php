<?php
/** @var string $content */
$pageTitle = $pageTitle ?? 'Panel docente';
$basePath = $basePath ?? '../';
$navActive = $navActive ?? '';
$useBootstrap = !empty($useBootstrap);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Utils\Sanitizer::escape($pageTitle) ?> - Docente</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= App\Utils\Sanitizer::escape($basePath) ?>css/main.css">
    <?php require BASE_PATH . '/inc/a11y-head.php'; ?>
    <?php if ($useBootstrap): ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php endif; ?>
</head>
<body class="docente-body">
<?php require BASE_PATH . '/inc/a11y-body-start.php'; ?>
<a class="skip-link" href="#contenido-docente">Saltar al contenido</a>

<?php App\Utils\View::component('header', ['basePath' => $basePath]); ?>
<?php App\Utils\View::component('nav-docente', ['active' => $navActive]); ?>

<main id="contenido-docente" class="main-content docente-main" tabindex="-1">
    <?= $content ?>
</main>

<?php App\Utils\View::component('footer'); ?>

<?php if ($useBootstrap): ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php endif; ?>
<script src="<?= App\Utils\Sanitizer::escape($basePath) ?>js/docente.js" defer></script>
</body>
</html>
