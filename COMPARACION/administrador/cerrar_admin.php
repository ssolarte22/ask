<?php

require_once dirname(__DIR__) . '/bootstrap.php';

use App\Services\AuthService;
use App\Utils\Response;

AuthService::logout();
Response::redirect('login.php');
