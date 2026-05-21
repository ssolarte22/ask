<?php
/** Inyectar al inicio de <body> para que el botón sea visible sin hacer scroll */
$basePath = $basePath ?? '';
App\Utils\View::component('accessibility-toolbar', ['basePath' => $basePath]);
?>
