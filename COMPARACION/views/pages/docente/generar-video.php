<div class="docente-panel">
    <section class="card-info">
        <h1>Generador de videos con IA</h1>
        <p class="lead">Convierte texto en videos con avatares que hablan (requiere API D-ID configurada).</p>

        <h2>Cómo funciona</h2>
        <p>Escribes un texto breve y claro; un avatar lo convierte en video con voz automática.</p>

        <h2>Ejemplo de prompt</h2>
        <blockquote class="prompt-box">
            Hola estudiantes, hoy veremos el ciclo del agua explicado de forma sencilla.
        </blockquote>

        <h2>Recomendaciones</h2>
        <ul>
            <li>No uses textos demasiado largos.</li>
            <li>Escribe de forma directa.</li>
            <li>Evita párrafos complejos.</li>
        </ul>
    </section>

    <section class="card-info">
        <h2>Generar video</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error" role="alert">
                <strong>No se pudo generar:</strong> <?= App\Utils\Sanitizer::escape($error) ?>
            </div>
        <?php endif; ?>

        <?php
        $didKey = App\Utils\Env::get('DID_API_KEY', '');
        if ($didKey === '' || $didKey === 'TU_API_KEY_AQUI' || str_starts_with($didKey, 'gsk_')):
        ?>
            <div class="alert alert-error" role="alert">
                Configura <code>DID_API_KEY</code> en <code>.env</code> con tu clave de
                <a href="https://studio.d-id.com/" target="_blank" rel="noopener">D-ID</a>
                (no es la misma que Groq).
            </div>
        <?php endif; ?>

        <form method="post" class="form-card">
            <div class="form-group">
                <label for="prompt-video">Texto del video</label>
                <textarea id="prompt-video" name="prompt" rows="5" required
                          aria-describedby="prompt-hint"><?= App\Utils\Sanitizer::escape($prompt ?? '') ?></textarea>
                <span id="prompt-hint" class="form-hint">Máximo recomendado: un párrafo corto.</span>
            </div>
            <button type="submit" <?= !empty($processing) ? 'disabled aria-busy="true"' : '' ?>>
                <?= !empty($processing) ? 'Generando…' : 'Generar video' ?>
            </button>
        </form>

        <?php if (!empty($processing)): ?>
            <p class="loading-msg" role="status">Generando video, por favor espera…</p>
        <?php endif; ?>

        <?php if (!empty($videoUrl)): ?>
            <div class="video-result">
                <h3>Video generado</h3>
                <video controls width="100%">
                    <source src="<?= App\Utils\Sanitizer::escape($videoUrl) ?>">
                    Tu navegador no soporta la reproducción de video.
                </video>
            </div>
        <?php endif; ?>
    </section>
</div>
