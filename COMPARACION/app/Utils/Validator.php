<?php

declare(strict_types=1);

namespace App\Utils;

final class Validator
{
    /** @return array<string, string> */
    public static function login(array $data): array
    {
        $errors = [];
        $login = Sanitizer::string($data['login'] ?? '', 50);
        $clave = (string) ($data['clave'] ?? '');

        if ($login === '') {
            $errors['login'] = 'El usuario es obligatorio.';
        } elseif (strlen($login) < 3) {
            $errors['login'] = 'El usuario debe tener al menos 3 caracteres.';
        }

        if ($clave === '') {
            $errors['clave'] = 'La contraseña es obligatoria.';
        } elseif (strlen($clave) < 3) {
            $errors['clave'] = 'La contraseña debe tener al menos 3 caracteres.';
        }

        return $errors;
    }

    /** @return array<string, string> */
    public static function docente(array $data): array
    {
        $errors = [];
        $login = Sanitizer::string($data['login'] ?? '', 50);
        $nombre = Sanitizer::string($data['nombre'] ?? '', 120);
        $clave = (string) ($data['clave'] ?? '');

        if ($login === '') {
            $errors['login'] = 'El login es obligatorio.';
        }
        if ($nombre === '') {
            $errors['nombre'] = 'El nombre es obligatorio.';
        }
        if ($clave === '') {
            $errors['clave'] = 'La contraseña es obligatoria.';
        }

        return $errors;
    }

    /** @return array<string, string> */
    public static function configuracion(array $data): array
    {
        $errors = [];
        $limite = Sanitizer::int($data['limite'] ?? 0, 1, 50);
        $duracion = Sanitizer::int($data['duracion'] ?? 0, 5, 120);

        if ($limite < 1) {
            $errors['limite'] = 'El límite de videos debe ser entre 1 y 50.';
        }
        if ($duracion < 5) {
            $errors['duracion'] = 'La duración debe ser entre 5 y 120 segundos.';
        }

        return $errors;
    }
}
