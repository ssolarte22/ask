<section class="content-card">
    <h1>Resumen de la plataforma</h1>
    <p>Bienvenido, <?= App\Utils\Sanitizer::escape($_SESSION['usuario'] ?? 'Administrador') ?>.
       Ingreso: <?= App\Utils\Sanitizer::escape($_SESSION['hora_ingreso'] ?? '') ?></p>

    <div class="panel-docente">
        <article class="card-info">
            <h2>Docentes</h2>
            <p style="font-size:2rem;font-weight:700;"><?= (int) ($totalDocentes ?? 0) ?></p>
            <a class="btn" href="docentes_admin.php">Gestionar</a>
        </article>
        <article class="card-info">
            <h2>Cursos</h2>
            <p style="font-size:2rem;font-weight:700;">2</p>
            <a class="btn" href="cursos_admin.php">Editar</a>
        </article>
        <article class="card-info">
            <h2>Configuración</h2>
            <a class="btn" href="config_admin.php">Modificar</a>
        </article>
    </div>
</section>
