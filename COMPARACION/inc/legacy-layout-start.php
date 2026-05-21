<?php
/** @var string $pageTitle */
/** @var string $navActive */
/** @var string $basePath */
if (!defined('BASE_PATH')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}
$basePath = $basePath ?? '';
$navActive = $navActive ?? '';
$pageTitle = $pageTitle ?? 'Colegio Mayor del Cauca';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Utils\Sanitizer::escape($pageTitle) ?> - Colegio Mayor del Cauca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= App\Utils\Sanitizer::escape($basePath) ?>css/main.css">
    <?php require BASE_PATH . '/inc/a11y-head.php'; ?>
</head>
<body>
<?php require BASE_PATH . '/inc/a11y-body-start.php'; ?>
<a class="skip-link" href="#contenido-principal">Saltar al contenido</a>
<?php App\Utils\View::component('header', ['basePath' => $basePath]); ?>
<?php App\Utils\View::component('nav-public', ['basePath' => $basePath, 'active' => $navActive]); ?>
<main id="contenido-principal" class="main-content" tabindex="-1">
<section class="content-card">
