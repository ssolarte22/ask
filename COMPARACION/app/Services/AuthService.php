<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Usuario;
use App\Utils\Sanitizer;
use App\Utils\Validator;

final class AuthService
{
    /** @return array{ok: bool, errors?: array<string, string>, user?: array<string, mixed>} */
    public static function login(array $input, string $expectedRole): array
    {
        $errors = Validator::login($input);
        if ($errors !== []) {
            return ['ok' => false, 'errors' => $errors];
        }

        $login = Sanitizer::string($input['login'] ?? '');
        $password = (string) ($input['clave'] ?? '');

        try {
            $user = Usuario::findByLogin($login);
        } catch (\Throwable) {
            return ['ok' => false, 'errors' => ['general' => 'Error de conexión. Verifique la base de datos.']];
        }

        if ($user === null || $user['rol'] !== $expectedRole) {
            return ['ok' => false, 'errors' => ['general' => 'Usuario o contraseña incorrectos.']];
        }

        if (!password_verify($password, $user['password_hash'])) {
            return ['ok' => false, 'errors' => ['general' => 'Usuario o contraseña incorrectos.']];
        }

        $_SESSION['usuario_id'] = (int) $user['id'];
        $_SESSION['usuario'] = $user['nombre'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['autenticado'] = true;
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['hora_ingreso'] = date('Y-m-d H:i:s');

        unset($user['password_hash']);
        return ['ok' => true, 'user' => $user];
    }

    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                (bool) $params['secure'],
                (bool) $params['httponly']
            );
        }
        session_destroy();
    }

    public static function isAuthenticated(): bool
    {
        return !empty($_SESSION['autenticado']);
    }

    public static function role(): ?string
    {
        return $_SESSION['rol'] ?? null;
    }
}
