<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Services\AuthService;
use App\Utils\Response;

final class AuthMiddleware
{
    public static function requireRole(string $role, string $redirectUrl): void
    {
        if (!AuthService::isAuthenticated() || AuthService::role() !== $role) {
            $isApi = str_contains($_SERVER['SCRIPT_NAME'] ?? '', '/api/');
            if ($isApi) {
                Response::json(['error' => 'No autorizado'], 401);
            }
            Response::redirect($redirectUrl);
        }
    }
}
