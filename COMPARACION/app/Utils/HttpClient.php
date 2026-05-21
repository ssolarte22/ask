<?php

declare(strict_types=1);

namespace App\Utils;

final class HttpClient
{
    /** @param array<string, mixed> $options */
    public static function request(string $url, array $options = []): array
    {
        if (!function_exists('curl_init')) {
            return [
                'ok' => false,
                'status' => 0,
                'body' => '',
                'error' => 'La extensión cURL no está habilitada en PHP. Actívala en php.ini de XAMPP.',
            ];
        }

        $ch = curl_init($url);
        $method = strtoupper((string) ($options['method'] ?? 'GET'));
        $headers = $options['headers'] ?? [];
        $body = $options['body'] ?? null;
        $timeout = (int) ($options['timeout'] ?? 60);
        $auth = $options['auth'] ?? null;

        $curlOpts = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ];

        if ($method === 'POST') {
            $curlOpts[CURLOPT_POST] = true;
            if ($body !== null) {
                $curlOpts[CURLOPT_POSTFIELDS] = is_string($body) ? $body : json_encode($body);
            }
        }

        if ($auth !== null) {
            $curlOpts[CURLOPT_USERPWD] = $auth;
        }

        curl_setopt_array($ch, $curlOpts);
        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        $curlError = curl_error($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($errno !== 0) {
            $hint = str_contains(strtolower($curlError), 'ssl')
                ? ' Si usas XAMPP en local, revisa curl.cainfo en php.ini o actualiza certificados.'
                : '';
            return [
                'ok' => false,
                'status' => $status,
                'body' => (string) $response,
                'error' => 'Error de red: ' . $curlError . $hint,
            ];
        }

        return [
            'ok' => $status >= 200 && $status < 300,
            'status' => $status,
            'body' => (string) $response,
            'error' => null,
        ];
    }

    /** @return array<string, mixed>|null */
    public static function decodeJson(string $body): ?array
    {
        if ($body === '') {
            return null;
        }
        $data = json_decode($body, true);
        return is_array($data) ? $data : null;
    }

    public static function apiErrorMessage(?array $json, int $status, string $fallback): string
    {
        if ($json !== null) {
            if (isset($json['error']['message'])) {
                return (string) $json['error']['message'];
            }
            if (isset($json['error']) && is_string($json['error'])) {
                return $json['error'];
            }
            if (isset($json['message']) && is_string($json['message'])) {
                return $json['message'];
            }
            if (isset($json['description']) && is_string($json['description'])) {
                return $json['description'];
            }
        }

        $debug = Env::get('APP_DEBUG', 'false') === 'true';
        if ($debug && $status > 0) {
            return "{$fallback} (HTTP {$status})";
        }

        return $fallback;
    }
}
