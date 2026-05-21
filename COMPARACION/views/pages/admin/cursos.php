<section class="content-card">
    <h1>Editar contenido de los cursos</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-success" role="status"><?= App\Utils\Sanitizer::escape($mensaje) ?></div>
    <?php endif; ?>

    <p class="form-hint">Si el contenido es corto se muestra como texto. Para HTML completo, pégalo aquí y se guardará en MariaDB y en los archivos de respaldo.</p>
    <form method="post" class="form-card">
        <div class="form-group">
            <label for="curso1">Curso 1: Cómo hacer prompts</label>
            <textarea id="curso1" name="curso1" rows="15"><?= App\Utils\Sanitizer::escape($curso1 ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label for="curso2">Curso 2: Plataformas IA</label>
            <textarea id="curso2" name="curso2" rows="15"><?= App\Utils\Sanitizer::escape($curso2 ?? '') ?></textarea>
        </div>
        <button type="submit" name="guardar" value="1">Guardar cambios</button>
    </form>
</section>
