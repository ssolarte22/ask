<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Utils\Response;
use App\Utils\View;

final class AuthController
{
    public static function docenteLoginForm(): void
    {
        $errors = [];
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
            $result = AuthService::login($_POST, 'docente');
            if ($result['ok']) {
                Response::redirect('docente/homeDocente.php');
            }
            $errors = $result['errors'] ?? [];
            $mensaje = $errors['general'] ?? null;
        }

        View::render('public/verificacion', [
            'pageTitle' => 'Acceso Docente',
            'mensajeError' => $mensaje,
            'errors' => $errors,
            'basePath' => '',
            'navActive' => 'docente',
        ]);
    }

    public static function adminLoginForm(): void
    {
        View::render('admin/login', [
            'pageTitle' => 'Acceso Administrador',
            'error' => isset($_GET['error']),
            'basePath' => '../',
        ], 'admin');
    }

    public static function adminVerify(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Response::redirect('login.php');
        }

        $result = AuthService::login($_POST, 'admin');
        if ($result['ok']) {
            Response::redirect('dashboard_admin.php');
        }
        Response::redirect('login.php?error=1');
    }
}
