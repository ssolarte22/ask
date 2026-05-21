<div class="docente-panel">
    <section class="card-info">
        <h1>Tutorial de Videos con IA</h1>
        <p class="lead">
            Bienvenido al sistema de aprendizaje del Colegio Mayor del Cauca.
            Aquí encontrarás recursos de IA y bases de datos aplicados a la educación.
        </p>
    </section>

    <section class="card-info">
        <h2>Información del docente</h2>
        <dl class="info-list">
            <dt>Usuario</dt>
            <dd><?= App\Utils\Sanitizer::escape($usuarioNombre) ?></dd>
            <dt>Hora de ingreso</dt>
            <dd><?= App\Utils\Sanitizer::escape($horaIngreso) ?></dd>
        </dl>
    </section>

    <section class="card-info">
        <h2 id="tutoriales-titulo">Tutoriales recomendados</h2>
        <p class="form-hint">Marca los que ya completaste (se guardan en tu navegador).</p>
        <ul class="checklist" aria-labelledby="tutoriales-titulo">
            <?php foreach ($tutoriales as $t): ?>
            <li>
                <input type="checkbox" id="<?= App\Utils\Sanitizer::escape($t['id']) ?>"
                       data-tutorial-id="<?= App\Utils\Sanitizer::escape($t['id']) ?>">
                <label for="<?= App\Utils\Sanitizer::escape($t['id']) ?>">
                    <?= App\Utils\Sanitizer::escape($t['label']) ?>
                </label>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="card-info">
        <h2>Módulos disponibles</h2>
        <div class="table-responsive">
            <table>
                <caption class="visually-hidden">Módulos del panel docente</caption>
                <thead>
                    <tr>
                        <th scope="col">Módulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tutoriales</td>
                        <td>Aprende a usar IA para crear videos educativos</td>
                        <td>Activo</td>
                    </tr>
                    <tr>
                        <td>Plataformas IA</td>
                        <td>Herramientas de generación de contenido</td>
                        <td>Activo</td>
                    </tr>
                    <tr>
                        <td>Prompts</td>
                        <td>Domina la creación de instrucciones para IA</td>
                        <td>Activo</td>
                    </tr>
                    <tr>
                        <td>Ética docente</td>
                        <td>Uso responsable de inteligencia artificial</td>
                        <td>Activo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="card-info">
        <h2>Acceso rápido</h2>
        <div class="quick-links">
            <a class="btn" href="curso1.php">Curso 1</a>
            <a class="btn" href="curso2.php">Curso 2</a>
            <a class="btn" href="formacion.php">Formación</a>
            <a class="btn" href="generarVideo.php">Generar video</a>
            <a class="btn" href="generarPrompts.php">Generar prompt</a>
        </div>
    </section>
</div>
