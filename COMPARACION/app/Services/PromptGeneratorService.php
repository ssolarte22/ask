<?php

declare(strict_types=1);

namespace App\Services;

use App\Utils\Env;
use App\Utils\HttpClient;
use App\Utils\Sanitizer;

final class PromptGeneratorService
{
    /** @return array{ok: bool, prompt?: string, error?: string} */
    public static function generateFromIdea(string $idea): array
    {
        $idea = Sanitizer::string($idea, 2000);
        if ($idea === '') {
            return ['ok' => false, 'error' => 'Escribe una idea para generar el prompt.'];
        }

        $apiKey = trim((string) Env::get('GROQ_API_KEY', ''));
        if ($apiKey === '' || $apiKey === 'TU_GROQ_API_KEY') {
            return [
                'ok' => false,
                'error' => 'Configura GROQ_API_KEY en el archivo .env (obtén una clave gratis en console.groq.com).',
            ];
        }

        if (!str_starts_with($apiKey, 'gsk_')) {
            return [
                'ok' => false,
                'error' => 'GROQ_API_KEY no tiene formato válido. Debe empezar por gsk_.',
            ];
        }

        $payload = [
            'model' => Env::get('GROQ_MODEL', 'llama-3.3-70b-versatile'),
            'messages' => [[
                'role' => 'user',
                'content' => "Convierte esta idea en un prompt educativo profesional.\n\n"
                    . "Incluye: rol de la IA, objetivo, contexto, instrucciones, estilo y formato.\n\n"
                    . "Idea:\n{$idea}",
            ]],
            'temperature' => 0.7,
            'max_tokens' => 800,
        ];

        $response = HttpClient::request('https://api.groq.com/openai/v1/chat/completions', [
            'method' => 'POST',
            'timeout' => 45,
            'headers' => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
            ],
            'body' => json_encode($payload),
        ]);

        if (!empty($response['error'])) {
            return ['ok' => false, 'error' => (string) $response['error']];
        }

        $result = HttpClient::decodeJson($response['body']);
        if (!$response['ok'] || !isset($result['choices'][0]['message']['content'])) {
            $msg = HttpClient::apiErrorMessage($result, $response['status'], 'No se pudo generar el prompt.');
            return ['ok' => false, 'error' => $msg];
        }

        return [
            'ok' => true,
            'prompt' => trim((string) $result['choices'][0]['message']['content']),
        ];
    }
}
