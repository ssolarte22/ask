<?php

require_once __DIR__ . '/bootstrap.php';

App\Utils\View::render('public/home', [
    'pageTitle' => 'Inicio',
    'navActive' => 'inicio',
    'basePath' => '',
]);
