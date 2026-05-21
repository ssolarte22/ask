<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\Configuracion;
use App\Services\DocenteService;
use App\Utils\Sanitizer;
use App\Utils\Validator;
use App\Utils\View;

final class ConfigAdminController
{
    public static function index(): void
    {
        AuthMiddleware::requireRole('admin', 'login.php');

        $mensaje = null;
        $errors = [];
        $config = [
            'limite_videos_dia' => Configuracion::get('limite_videos_dia', '5'),
            'duracion_maxima' => Configuracion::get('duracion_maxima', '10'),
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
            $errors = Validator::configuracion($_POST);
            if ($errors === []) {
                Configuracion::set('limite_videos_dia', (string) Sanitizer::int($_POST['limite'] ?? 5, 1, 50));
                Configuracion::set('duracion_maxima', (string) Sanitizer::int($_POST['duracion'] ?? 10, 5, 120));
                $config = [
                    'limite_videos_dia' => Configuracion::get('limite_videos_dia'),
                    'duracion_maxima' => Configuracion::get('duracion_maxima'),
                ];
                $mensaje = 'Configuración guardada correctamente.';
            }
        }

        $docentes = DocenteService::paginated(1, 50)['items'];

        View::render('admin/config', [
            'pageTitle' => 'Configuración',
            'config' => $config,
            'docentes' => $docentes,
            'mensaje' => $mensaje,
            'errors' => $errors,
            'basePath' => '../',
        ], 'admin');
    }
}
