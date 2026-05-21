<section class="content-card">
    <h1>Configuración general</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-success" role="status"><?= App\Utils\Sanitizer::escape($mensaje) ?></div>
    <?php endif; ?>

    <form method="post" class="form-card form-narrow">
        <div class="form-group">
            <label for="limite">Límite de videos por día</label>
            <input type="number" id="limite" name="limite" min="1" max="50" required
                   value="<?= App\Utils\Sanitizer::escape($config['limite_videos_dia']) ?>">
            <?php if (!empty($errors['limite'])): ?>
                <span class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['limite']) ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="duracion">Duración máxima (segundos)</label>
            <input type="number" id="duracion" name="duracion" min="5" max="120" required
                   value="<?= App\Utils\Sanitizer::escape($config['duracion_maxima']) ?>">
            <?php if (!empty($errors['duracion'])): ?>
                <span class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['duracion']) ?></span>
            <?php endif; ?>
        </div>
        <button type="submit" name="guardar" value="1">Guardar configuración</button>
    </form>

    <h2>Docentes activos (solo login y nombre)</h2>
    <ul>
        <?php foreach ($docentes as $d): ?>
            <li><strong><?= App\Utils\Sanitizer::escape($d['login']) ?></strong> — <?= App\Utils\Sanitizer::escape($d['nombre']) ?></li>
        <?php endforeach; ?>
    </ul>
</section>
