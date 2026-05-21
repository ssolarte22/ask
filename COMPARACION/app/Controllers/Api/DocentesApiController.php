<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Middleware\AuthMiddleware;
use App\Services\DocenteService;
use App\Utils\Response;
use App\Utils\Sanitizer;

final class DocentesApiController
{
    public static function list(): void
    {
        AuthMiddleware::requireRole('admin', '../administrador/login.php');

        $page = Sanitizer::int($_GET['page'] ?? 1, 1, 999);
        $perPage = Sanitizer::int($_GET['per_page'] ?? 10, 1, 50);
        $data = DocenteService::paginated($page, $perPage);

        Response::json([
            'data' => $data['items'],
            'meta' => $data['meta'],
        ]);
    }

    public static function create(): void
    {
        AuthMiddleware::requireRole('admin', '../administrador/login.php');

        $payload = json_decode(file_get_contents('php://input') ?: '{}', true);
        if (!is_array($payload)) {
            Response::json(['error' => 'JSON inválido'], 400);
        }

        $result = DocenteService::create($payload);
        if (!$result['ok']) {
            Response::json(['errors' => $result['errors']], 422);
        }

        Response::json(['id' => $result['id'], 'message' => 'Docente creado'], 201);
    }

    public static function delete(): void
    {
        AuthMiddleware::requireRole('admin', '../administrador/login.php');

        $id = Sanitizer::int($_GET['id'] ?? 0, 1);
        if ($id < 1) {
            Response::json(['error' => 'ID inválido'], 400);
        }

        $ok = DocenteService::delete($id);
        Response::json(['deleted' => $ok]);
    }
}
