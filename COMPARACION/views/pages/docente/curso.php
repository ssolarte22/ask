<div class="docente-curso">
    <header class="curso-header">
        <h1><?= App\Utils\Sanitizer::escape($titulo) ?></h1>
        <?php if (!empty($descripcion)): ?>
            <p class="lead"><?= App\Utils\Sanitizer::escape($descripcion) ?></p>
        <?php endif; ?>
    </header>

    <?= $contenidoHtml ?>

    <p class="mt-lg">
        <a class="btn btn-volver" href="<?= App\Utils\Sanitizer::escape($volverHref ?? 'homeDocente.php') ?>">
            Volver al inicio
        </a>
    </p>
</div>
