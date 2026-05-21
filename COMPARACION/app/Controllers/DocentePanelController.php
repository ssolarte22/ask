<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\Usuario;
use App\Services\AuthService;
use App\Services\CursoService;
use App\Services\PromptGeneratorService;
use App\Services\VideoGeneratorService;
use App\Utils\Sanitizer;
use App\Utils\View;

final class DocentePanelController
{
    private static function guard(): void
    {
        AuthMiddleware::requireRole('docente', '../verificacion.php');
    }

    private static function render(string $view, array $data = []): void
    {
        self::guard();
        View::render('docente/' . $view, array_merge([
            'basePath' => '../',
            'usuarioNombre' => $_SESSION['usuario'] ?? '',
            'horaIngreso' => $_SESSION['hora_ingreso'] ?? '',
            'login' => $_SESSION['login'] ?? '',
        ], $data), 'docente');
    }

    public static function home(): void
    {
        $tutoriales = [
            ['id' => 't1', 'label' => 'Cómo crear rúbricas con IA'],
            ['id' => 't2', 'label' => 'Generar videos explicativos con Synthesia'],
            ['id' => 't3', 'label' => 'Crear preguntas automáticas con ChatGPT'],
            ['id' => 't4', 'label' => 'Las 5 mejores plataformas IA para docentes'],
            ['id' => 't5', 'label' => 'Cómo escribir prompts efectivos'],
            ['id' => 't6', 'label' => 'Crear avatar docente con HeyGen'],
        ];

        self::render('home', [
            'pageTitle' => 'Panel docente',
            'navActive' => 'inicio',
            'tutoriales' => $tutoriales,
        ]);
    }

    public static function perfil(): void
    {
        $usuario = null;
        try {
            $id = (int) ($_SESSION['usuario_id'] ?? 0);
            if ($id > 0) {
                $usuario = Usuario::findById($id);
            }
        } catch (\Throwable) {
            $usuario = null;
        }

        self::render('perfil', [
            'pageTitle' => 'Mi perfil',
            'navActive' => 'perfil',
            'usuario' => $usuario,
        ]);
    }

    public static function formacion(): void
    {
        self::render('formacion', [
            'pageTitle' => 'Formación',
            'navActive' => 'formacion',
            'useBootstrap' => true,
        ]);
    }

    public static function curso1(): void
    {
        self::render('curso', [
            'pageTitle' => 'Curso 1 - Prompts',
            'navActive' => 'curso1',
            'titulo' => 'Tutorial de creación de prompts para IA',
            'descripcion' => 'Aprende a escribir instrucciones efectivas para obtener mejores resultados con inteligencia artificial.',
            'contenidoHtml' => CursoService::getContenidoHtml('curso-1', 'curso-1-default'),
            'volverHref' => 'homeDocente.php',
        ]);
    }

    public static function curso2(): void
    {
        self::render('curso', [
            'pageTitle' => 'Curso 2 - Videos IA',
            'navActive' => 'curso2',
            'titulo' => 'Plataformas IA para crear videos',
            'descripcion' => 'Aprende a usar herramientas para crear videos educativos con inteligencia artificial.',
            'contenidoHtml' => CursoService::getContenidoHtml('curso-2', 'curso-2-default'),
            'volverHref' => 'homeDocente.php',
        ]);
    }

    public static function generarVideo(): void
    {
        @set_time_limit(300);

        $error = '';
        $videoUrl = '';
        $prompt = trim((string) ($_POST['prompt'] ?? ''));
        $processing = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $prompt !== '') {
            $processing = true;
            $id = (int) ($_SESSION['usuario_id'] ?? 0);
            $result = VideoGeneratorService::generate($prompt, $id);
            $processing = false;
            if ($result['ok']) {
                $videoUrl = $result['video_url'] ?? '';
            } else {
                $error = $result['error'] ?? 'Error desconocido.';
            }
        }

        self::render('generar-video', [
            'pageTitle' => 'Generar video',
            'navActive' => 'video',
            'prompt' => $prompt,
            'error' => $error,
            'videoUrl' => $videoUrl,
            'processing' => $processing,
        ]);
    }

    public static function generarPrompts(): void
    {
        $error = '';
        $promptGenerado = '';
        $idea = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idea = Sanitizer::string($_POST['idea'] ?? '', 2000);
            $result = PromptGeneratorService::generateFromIdea($idea);
            if ($result['ok']) {
                $promptGenerado = $result['prompt'] ?? '';
            } else {
                $error = $result['error'] ?? 'Error al generar.';
            }
        }

        self::render('generar-prompts', [
            'pageTitle' => 'Generar prompt',
            'navActive' => 'prompts',
            'idea' => $idea,
            'promptGenerado' => $promptGenerado,
            'error' => $error,
        ]);
    }
}
