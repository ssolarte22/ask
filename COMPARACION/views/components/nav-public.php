<?php
$basePath = $basePath ?? '';
$active = $active ?? '';
$items = [
    'inicio' => ['label' => 'Inicio', 'href' => $basePath . 'home.php'],
    'mision' => ['label' => 'Misión', 'href' => $basePath . 'Mision.php'],
    'vision' => ['label' => 'Visión', 'href' => $basePath . 'Vision.php'],
    'catalogo' => ['label' => 'Catálogo', 'href' => $basePath . 'catalogo.php'],
    'faq' => ['label' => 'FAQ', 'href' => $basePath . 'preguntas.php'],
    'docente' => ['label' => 'Docente', 'href' => $basePath . 'verificacion.php'],
    'admin' => ['label' => 'Administrador', 'href' => $basePath . 'administrador/login.php'],
];
?>
<nav class="site-nav" aria-label="Navegación principal">
    <ul class="nav-list">
        <?php foreach ($items as $key => $item): ?>
            <li>
                <a href="<?= App\Utils\Sanitizer::escape($item['href']) ?>"
                   class="<?= $active === $key ? 'is-active' : '' ?>"
                   <?= $active === $key ? 'aria-current="page"' : '' ?>>
                    <?= App\Utils\Sanitizer::escape($item['label']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
