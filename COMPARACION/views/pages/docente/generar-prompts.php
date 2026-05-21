<div class="docente-panel">
    <section class="card-info">
        <h1>Generador de prompts con IA</h1>
        <p class="lead">Convierte ideas simples en prompts profesionales listos para usar.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error" role="alert">
                <strong>No se pudo generar:</strong> <?= App\Utils\Sanitizer::escape($error) ?>
            </div>
        <?php endif; ?>

        <?php if (empty(App\Utils\Env::get('GROQ_API_KEY')) || App\Utils\Env::get('GROQ_API_KEY') === 'TU_GROQ_API_KEY'): ?>
            <div class="alert alert-error" role="alert">
                Falta <code>GROQ_API_KEY</code> en el archivo <code>.env</code> del proyecto.
            </div>
        <?php endif; ?>

        <form method="post" class="form-card">
            <div class="form-group">
                <label for="idea">Tu idea</label>
                <textarea id="idea" name="idea" rows="5" required
                          placeholder="Ejemplo: explicar el ciclo del agua"><?= App\Utils\Sanitizer::escape($idea ?? '') ?></textarea>
            </div>
            <button type="submit">Generar prompt</button>
        </form>
    </section>

    <?php if (!empty($promptGenerado)): ?>
    <section class="card-info">
        <h2>Prompt generado</h2>
        <div class="prompt-result"><?= nl2br(App\Utils\Sanitizer::escape($promptGenerado)) ?></div>

        <form method="post" action="generarVideo.php" class="mt-lg">
            <input type="hidden" name="prompt" value="<?= App\Utils\Sanitizer::escape($promptGenerado) ?>">
            <button type="submit">Usar para generar video</button>
        </form>
    </section>
    <?php endif; ?>
</div>
