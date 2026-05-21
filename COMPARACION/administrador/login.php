<?php

require_once dirname(__DIR__) . '/bootstrap.php';
require_once BASE_PATH . '/app/Controllers/AuthController.php';

App\Controllers\AuthController::adminLoginForm();
