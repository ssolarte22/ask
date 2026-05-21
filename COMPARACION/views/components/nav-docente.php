<?php
$active = $active ?? '';
$items = [
    'inicio' => ['label' => 'Inicio', 'href' => 'homeDocente.php'],
    'perfil' => ['label' => 'Perfil', 'href' => 'perfil.php'],
    'formacion' => ['label' => 'Formación', 'href' => 'formacion.php'],
    'curso1' => ['label' => 'Curso 1', 'href' => 'curso1.php'],
    'curso2' => ['label' => 'Curso 2', 'href' => 'curso2.php'],
    'video' => ['label' => 'Generar video', 'href' => 'generarVideo.php'],
    'prompts' => ['label' => 'Generar prompt', 'href' => 'generarPrompts.php'],
    'cerrar' => ['label' => 'Cerrar sesión', 'href' => 'cerrar.php'],
];
?>
<nav class="site-nav docente-nav" aria-label="Navegación del panel docente">
    <ul class="nav-list">
        <?php foreach ($items as $key => $item): ?>
            <li>
                <a href="<?= App\Utils\Sanitizer::escape($item['href']) ?>"
                   class="<?= $active === $key ? 'is-active' : '' ?><?= $key === 'cerrar' ? ' nav-logout' : '' ?>"
                   <?= $active === $key ? 'aria-current="page"' : '' ?>>
                    <?= App\Utils\Sanitizer::escape($item['label']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
