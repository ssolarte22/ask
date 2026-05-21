<?php

declare(strict_types=1);

define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/app/Utils/Env.php';
require_once BASE_PATH . '/app/Utils/Sanitizer.php';
require_once BASE_PATH . '/app/Utils/Validator.php';
require_once BASE_PATH . '/app/Utils/Response.php';
require_once BASE_PATH . '/app/Utils/View.php';
require_once BASE_PATH . '/app/Config/Database.php';
require_once BASE_PATH . '/app/Models/Usuario.php';
require_once BASE_PATH . '/app/Models/Configuracion.php';
require_once BASE_PATH . '/app/Utils/HttpClient.php';
require_once BASE_PATH . '/app/Services/AuthService.php';
require_once BASE_PATH . '/app/Services/DocenteService.php';
require_once BASE_PATH . '/app/Services/PromptGeneratorService.php';
require_once BASE_PATH . '/app/Services/VideoGeneratorService.php';
require_once BASE_PATH . '/app/Services/CursoService.php';
require_once BASE_PATH . '/app/Models/Curso.php';
require_once BASE_PATH . '/app/Middleware/AuthMiddleware.php';

App\Utils\Env::load(BASE_PATH . '/.env');

$sessionName = App\Utils\Env::get('SESSION_NAME', 'entrega_ia_session');
if (session_status() === PHP_SESSION_NONE) {
    session_name($sessionName);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}
