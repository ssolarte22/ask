<?php

require_once dirname(__DIR__) . '/bootstrap.php';

use App\Middleware\AuthMiddleware;
use App\Models\Curso;
use App\Utils\Sanitizer;
use App\Utils\View;

AuthMiddleware::requireRole('admin', 'login.php');

$rutaCurso1 = dirname(__DIR__) . '/curso1_contenido.txt';
$rutaCurso2 = dirname(__DIR__) . '/curso2_contenido.txt';
$mensaje = null;

if (isset($_POST['guardar'])) {
    $c1 = Sanitizer::string($_POST['curso1'] ?? '', 50000);
    $c2 = Sanitizer::string($_POST['curso2'] ?? '', 50000);
    file_put_contents($rutaCurso1, $c1);
    file_put_contents($rutaCurso2, $c2);

    try {
        Curso::updateContenido('curso-1', $c1);
        Curso::updateContenido('curso-2', $c2);
    } catch (\Throwable) {
        // Archivos .txt siguen funcionando como respaldo
    }

    $mensaje = 'Contenido guardado correctamente.';
}

$curso1 = '';
$curso2 = '';

try {
    $db1 = Curso::findBySlug('curso-1');
    $db2 = Curso::findBySlug('curso-2');
    if ($db1 && trim((string) ($db1['contenido'] ?? '')) !== '') {
        $curso1 = (string) $db1['contenido'];
    }
    if ($db2 && trim((string) ($db2['contenido'] ?? '')) !== '') {
        $curso2 = (string) $db2['contenido'];
    }
} catch (\Throwable) {
    // fallback a archivos
}

if ($curso1 === '' && is_readable($rutaCurso1)) {
    $curso1 = (string) file_get_contents($rutaCurso1);
}
if ($curso2 === '' && is_readable($rutaCurso2)) {
    $curso2 = (string) file_get_contents($rutaCurso2);
}

View::render('admin/cursos', [
    'pageTitle' => 'Editar cursos',
    'curso1' => $curso1,
    'curso2' => $curso2,
    'mensaje' => $mensaje,
    'basePath' => '../',
], 'admin');
