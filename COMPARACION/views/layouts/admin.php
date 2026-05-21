<?php
/** @var string $content */
/** @var string $pageTitle */
/** @var string $basePath */
$basePath = $basePath ?? '../';
$pageTitle = $pageTitle ?? 'Administración';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Utils\Sanitizer::escape($pageTitle) ?> - Admin</title>
    <link rel="stylesheet" href="<?= App\Utils\Sanitizer::escape($basePath) ?>css/main.css">
    <?php require BASE_PATH . '/inc/a11y-head.php'; ?>
</head>
<body class="admin-body">
<?php require BASE_PATH . '/inc/a11y-body-start.php'; ?>
<a class="skip-link" href="#contenido-admin">Saltar al contenido</a>

<?php App\Utils\View::component('nav-admin', ['basePath' => '']); ?>

<main id="contenido-admin" class="main-content admin-main" tabindex="-1">
    <?= $content ?>
</main>

<?php App\Utils\View::component('footer', ['compact' => true]); ?>
</body>
</html>
