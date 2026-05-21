<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\Database;
use App\Models\Configuracion;
use App\Models\Usuario;
use App\Utils\Env;
use App\Utils\HttpClient;
use App\Utils\Sanitizer;

final class VideoGeneratorService
{
    /** @return array{ok: bool, video_url?: string, error?: string} */
    public static function generate(string $prompt, int $usuarioId): array
    {
        @set_time_limit(300);

        $prompt = Sanitizer::string($prompt, 3000);
        if ($prompt === '') {
            return ['ok' => false, 'error' => 'Escribe un texto para generar el video.'];
        }

        $apiKey = trim((string) Env::get('DID_API_KEY', ''));
        if ($apiKey === '' || $apiKey === 'TU_API_KEY_AQUI') {
            return [
                'ok' => false,
                'error' => 'Configura DID_API_KEY en .env. Obtén tu clave en https://studio.d-id.com/ (no uses la clave de Groq).',
            ];
        }

        if (str_starts_with($apiKey, 'gsk_')) {
            return [
                'ok' => false,
                'error' => 'DID_API_KEY incorrecta: parece una clave de Groq (gsk_...). '
                    . 'D-ID usa otra clave. Regístrate en studio.d-id.com y pega la API key de D-ID en .env.',
            ];
        }

        if ($usuarioId > 0) {
            $limite = (int) Configuracion::get('limite_videos_dia', '5');
            $usuario = Usuario::findById($usuarioId);
            if ($usuario !== null && (int) $usuario['videos_generados'] >= $limite) {
                return ['ok' => false, 'error' => "Has alcanzado el límite de {$limite} videos por día."];
            }
        }

        $presenterId = Env::get('DID_PRESENTER_ID', 'v2_public_Amber@0zSz8kflCN');

        $create = HttpClient::request('https://api.d-id.com/clips', [
            'method' => 'POST',
            'timeout' => 90,
            'auth' => $apiKey . ':',
            'headers' => ['Content-Type: application/json', 'Accept: application/json'],
            'body' => json_encode([
                'presenter_id' => $presenterId,
                'script' => ['type' => 'text', 'input' => $prompt],
            ]),
        ]);

        if (!empty($create['error'])) {
            return ['ok' => false, 'error' => (string) $create['error']];
        }

        $result = HttpClient::decodeJson($create['body']);
        if (!$create['ok'] || !isset($result['id'])) {
            $msg = HttpClient::apiErrorMessage(
                $result,
                $create['status'],
                'No se pudo crear el video. Verifica tu DID_API_KEY y créditos en D-ID.'
            );
            return ['ok' => false, 'error' => $msg];
        }

        $clipId = (string) $result['id'];
        $maxAttempts = 45;

        for ($i = 0; $i < $maxAttempts; $i++) {
            sleep(2);

            $statusReq = HttpClient::request('https://api.d-id.com/clips/' . rawurlencode($clipId), [
                'timeout' => 30,
                'auth' => $apiKey . ':',
                'headers' => ['Accept: application/json'],
            ]);

            if (!empty($statusReq['error'])) {
                return ['ok' => false, 'error' => (string) $statusReq['error']];
            }

            $status = HttpClient::decodeJson($statusReq['body']);
            $state = $status['status'] ?? '';

            if ($state === 'done' && !empty($status['result_url'])) {
                if ($usuarioId > 0) {
                    self::incrementVideos($usuarioId);
                }
                return ['ok' => true, 'video_url' => (string) $status['result_url']];
            }

            if ($state === 'error' || $state === 'rejected') {
                $detail = $status['error']['description'] ?? $status['error']['message'] ?? 'Error al procesar el video.';
                return ['ok' => false, 'error' => (string) $detail];
            }
        }

        return [
            'ok' => false,
            'error' => 'El video está tardando demasiado. Intenta con un texto más corto.',
        ];
    }

    private static function incrementVideos(int $usuarioId): void
    {
        $stmt = Database::connection()->prepare(
            'UPDATE usuarios SET videos_generados = videos_generados + 1 WHERE id = :id'
        );
        $stmt->execute(['id' => $usuarioId]);
    }
}
