<?php

$base = dirname(__DIR__) . '/';

foreach (['curso1' => 'curso-1-default', 'curso2' => 'curso-2-default'] as $src => $dest) {
    $content = file_get_contents($base . 'docente/' . $src . '.php');
    if (preg_match('/<div class="contenido-curso">(.*)<\/div>\s*<\/section>/s', $content, $m)) {
        $body = trim($m[1]);
        $body = str_replace('class="btn-volver"', 'class="btn btn-volver"', $body);
        file_put_contents($base . 'views/pages/docente/cursos/' . $dest . '.php', $body);
        echo "OK {$dest}\n";
    } else {
        echo "FAIL {$src}\n";
    }
}
