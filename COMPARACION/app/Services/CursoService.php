<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Curso;
use App\Utils\Sanitizer;

final class CursoService
{
    public static function getContenidoHtml(string $slug, string $fallbackPartial): string
    {
        try {
            $curso = Curso::findBySlug($slug);
            if ($curso !== null && trim((string) ($curso['contenido'] ?? '')) !== '') {
                return self::formatContenido((string) $curso['contenido']);
            }
        } catch (\Throwable) {
            // Fallback si la BD no está disponible
        }

        $txtFile = match ($slug) {
            'curso-1' => BASE_PATH . '/curso1_contenido.txt',
            'curso-2' => BASE_PATH . '/curso2_contenido.txt',
            default => null,
        };

        if ($txtFile !== null && is_readable($txtFile)) {
            $txt = trim((string) file_get_contents($txtFile));
            if ($txt !== '' && strlen($txt) > 20) {
                return '<div class="bloque curso-custom"><p>' . nl2br(Sanitizer::escape($txt)) . '</p></div>';
            }
        }

        $partial = BASE_PATH . '/views/pages/docente/cursos/' . $fallbackPartial . '.php';
        if (!is_readable($partial)) {
            return '<p class="alert alert-error">Contenido del curso no disponible.</p>';
        }

        ob_start();
        include $partial;
        return (string) ob_get_clean();
    }

    private static function formatContenido(string $contenido): string
    {
        if (str_contains($contenido, '<')) {
            return '<div class="bloque curso-custom">' . $contenido . '</div>';
        }
        return '<div class="bloque curso-custom"><p>' . nl2br(Sanitizer::escape($contenido)) . '</p></div>';
    }
}
