<div class="docente-panel">
    <section class="card-info">
        <h1>Mi perfil</h1>
        <p class="lead">Información de tu sesión en la plataforma.</p>

        <div class="table-responsive">
            <table>
                <caption class="visually-hidden">Datos del docente</caption>
                <tbody>
                    <tr>
                        <th scope="row">Nombre</th>
                        <td><?= App\Utils\Sanitizer::escape($usuario['nombre'] ?? $usuarioNombre) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Login</th>
                        <td><?= App\Utils\Sanitizer::escape($usuario['login'] ?? $login) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Hora de ingreso</th>
                        <td><?= App\Utils\Sanitizer::escape($horaIngreso) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Videos generados</th>
                        <td><?= (int) ($usuario['videos_generados'] ?? 0) ?></td>
                    </tr>
                    <?php if (!empty($usuario['created_at'])): ?>
                    <tr>
                        <th scope="row">Registro</th>
                        <td><?= App\Utils\Sanitizer::escape($usuario['created_at']) ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="quick-links mt-lg">
            <a class="btn" href="homeDocente.php">Volver al inicio</a>
            <a class="btn btn-danger" href="cerrar.php">Cerrar sesión</a>
        </div>
    </section>
</div>
