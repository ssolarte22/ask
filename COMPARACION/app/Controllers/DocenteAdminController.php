<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Services\DocenteService;
use App\Utils\Sanitizer;
use App\Utils\View;

final class DocenteAdminController
{
    public static function index(): void
    {
        AuthMiddleware::requireRole('admin', 'login.php');

        $page = Sanitizer::int($_GET['page'] ?? 1, 1, 999);
        $mensaje = null;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
            $result = DocenteService::create($_POST);
            if ($result['ok']) {
                header('Location: docentes_admin.php?ok=1');
                exit;
            }
            $errors = $result['errors'] ?? [];
        }

        if (isset($_GET['eliminar'])) {
            $id = Sanitizer::int($_GET['eliminar'], 1);
            DocenteService::delete($id);
            header('Location: docentes_admin.php?deleted=1');
            exit;
        }

        $data = DocenteService::paginated($page, 10);

        View::render('admin/docentes', [
            'pageTitle' => 'Gestión de Docentes',
            'docentes' => $data['items'],
            'meta' => $data['meta'],
            'errors' => $errors,
            'mensajeOk' => isset($_GET['ok']),
            'mensajeDeleted' => isset($_GET['deleted']),
            'basePath' => '../',
        ], 'admin');
    }
}
