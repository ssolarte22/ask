<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

require_once BASE_PATH . '/app/Controllers/Api/DocentesApiController.php';

use App\Controllers\Api\DocentesApiController;
use App\Utils\Response;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$resource = $_GET['resource'] ?? 'docentes';
$action = $_GET['action'] ?? 'list';

try {
    if ($resource === 'docentes') {
        match ("$method:$action") {
            'GET:list' => DocentesApiController::list(),
            'POST:create' => DocentesApiController::create(),
            'DELETE:delete' => DocentesApiController::delete(),
            default => Response::json(['error' => 'Ruta no encontrada'], 404),
        };
    } else {
        Response::json(['error' => 'Recurso no encontrado'], 404);
    }
} catch (\JsonException $e) {
    Response::json(['error' => 'Error al procesar la respuesta'], 500);
} catch (\Throwable $e) {
    $debug = App\Utils\Env::get('APP_DEBUG', 'false') === 'true';
    Response::json([
        'error' => 'Error interno del servidor',
        'detail' => $debug ? $e->getMessage() : null,
    ], 500);
}
