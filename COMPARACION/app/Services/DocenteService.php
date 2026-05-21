<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Usuario;
use App\Utils\Sanitizer;
use App\Utils\Validator;

final class DocenteService
{
    /** @return array{ok: bool, errors?: array<string, string>, id?: int} */
    public static function create(array $input): array
    {
        $errors = Validator::docente($input);
        if ($errors !== []) {
            return ['ok' => false, 'errors' => $errors];
        }

        $login = Sanitizer::string($input['login'] ?? '', 50);
        $nombre = Sanitizer::string($input['nombre'] ?? '', 120);
        $clave = (string) ($input['clave'] ?? '');

        if (Usuario::loginExists($login)) {
            return ['ok' => false, 'errors' => ['login' => 'Ese login ya está registrado.']];
        }

        $hash = password_hash($clave, PASSWORD_DEFAULT);
        $id = Usuario::createDocente($login, $nombre, $hash);

        return ['ok' => true, 'id' => $id];
    }

    public static function delete(int $id): bool
    {
        return Usuario::softDelete($id);
    }

    /** @return array{items: array<int, array<string, mixed>>, meta: array<string, int>} */
    public static function paginated(int $page = 1, int $perPage = 10): array
    {
        $page = max(1, $page);
        $perPage = max(1, min(50, $perPage));
        $total = Usuario::countDocentes();

        return [
            'items' => Usuario::listDocentes($page, $perPage),
            'meta' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'total_pages' => (int) ceil($total / $perPage),
            ],
        ];
    }
}
