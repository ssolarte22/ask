<section class="content-card">
    <h1>Gestión de Docentes</h1>

    <?php if (!empty($mensajeOk)): ?>
        <div class="alert alert-success" role="status">Docente agregado correctamente.</div>
    <?php endif; ?>
    <?php if (!empty($mensajeDeleted)): ?>
        <div class="alert alert-success" role="status">Docente eliminado.</div>
    <?php endif; ?>

    <h2>Agregar nuevo docente</h2>
    <form method="post" class="form-card">
        <div class="form-group">
            <label for="nuevo-login">Login</label>
            <input type="text" id="nuevo-login" name="login" required>
            <?php if (!empty($errors['login'])): ?>
                <span class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['login']) ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="nuevo-nombre">Nombre completo</label>
            <input type="text" id="nuevo-nombre" name="nombre" required>
            <?php if (!empty($errors['nombre'])): ?>
                <span class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['nombre']) ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="nuevo-clave">Contraseña</label>
            <input type="password" id="nuevo-clave" name="clave" required autocomplete="new-password">
            <?php if (!empty($errors['clave'])): ?>
                <span class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['clave']) ?></span>
            <?php endif; ?>
        </div>
        <button type="submit" name="agregar" value="1">Agregar docente</button>
    </form>

    <h2>Lista de docentes</h2>
    <div class="table-responsive">
        <table>
            <caption class="visually-hidden">Docentes registrados en el sistema</caption>
            <thead>
                <tr>
                    <th scope="col">Login</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Registro</th>
                    <th scope="col">Videos</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docentes as $d): ?>
                <tr>
                    <td><?= App\Utils\Sanitizer::escape($d['login']) ?></td>
                    <td><?= App\Utils\Sanitizer::escape($d['nombre']) ?></td>
                    <td><?= App\Utils\Sanitizer::escape($d['created_at']) ?></td>
                    <td><?= (int) $d['videos_generados'] ?></td>
                    <td>
                        <a href="?eliminar=<?= (int) $d['id'] ?>"
                           onclick="return confirm('¿Eliminar este docente?')"
                           aria-label="Eliminar docente <?= App\Utils\Sanitizer::escape($d['login']) ?>">
                            Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($docentes)): ?>
                <tr><td colspan="5">No hay docentes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (($meta['total_pages'] ?? 1) > 1): ?>
    <nav class="pagination" aria-label="Paginación de docentes">
        <?php for ($p = 1; $p <= $meta['total_pages']; $p++): ?>
            <a href="?page=<?= $p ?>" class="<?= $p === $meta['page'] ? 'is-active' : '' ?>"
               <?= $p === $meta['page'] ? 'aria-current="page"' : '' ?>>
                <?= $p ?>
            </a>
        <?php endfor; ?>
    </nav>
    <?php endif; ?>
</section>
