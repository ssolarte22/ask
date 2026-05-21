<?php

require_once dirname(__DIR__) . '/bootstrap.php';

use App\Middleware\AuthMiddleware;
use App\Models\Usuario;
use App\Utils\View;

AuthMiddleware::requireRole('admin', 'login.php');

try {
    $totalDocentes = Usuario::countDocentes();
} catch (\Throwable) {
    $totalDocentes = 0;
}

View::render('admin/dashboard', [
    'pageTitle' => 'Panel de administración',
    'totalDocentes' => $totalDocentes,
    'basePath' => '../',
], 'admin');
