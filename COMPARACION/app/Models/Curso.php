<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

final class Curso
{
    public static function findBySlug(string $slug): ?array
    {
        $stmt = Database::connection()->prepare(
            'SELECT id, slug, titulo, descripcion, contenido, orden, activo
             FROM cursos WHERE slug = :slug AND activo = 1 LIMIT 1'
        );
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function updateContenido(string $slug, string $contenido): void
    {
        $stmt = Database::connection()->prepare(
            'UPDATE cursos SET contenido = :contenido WHERE slug = :slug'
        );
        $stmt->execute(['slug' => $slug, 'contenido' => $contenido]);
    }
}
