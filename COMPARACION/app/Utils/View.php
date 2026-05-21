<?php

declare(strict_types=1);

namespace App\Utils;

final class View
{
    /** @param array<string, mixed> $data */
    public static function render(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data, EXTR_SKIP);
        $viewPath = BASE_PATH . '/views/pages/' . $view . '.php';
        $layoutPath = BASE_PATH . '/views/layouts/' . $layout . '.php';

        if (!is_readable($viewPath)) {
            http_response_code(500);
            echo 'Vista no encontrada.';
            return;
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        if (is_readable($layoutPath)) {
            require $layoutPath;
            return;
        }

        echo $content;
    }

    public static function component(string $name, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $path = BASE_PATH . '/views/components/' . $name . '.php';
        if (is_readable($path)) {
            require $path;
        }
    }
}
