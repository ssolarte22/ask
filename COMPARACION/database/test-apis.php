<?php

require_once dirname(__DIR__) . '/bootstrap.php';
require_once BASE_PATH . '/app/Services/PromptGeneratorService.php';
require_once BASE_PATH . '/app/Services/VideoGeneratorService.php';

echo "curl: " . (function_exists('curl_init') ? 'yes' : 'no') . PHP_EOL;

$prompt = App\Services\PromptGeneratorService::generateFromIdea('explicar el ciclo del agua');
echo "Groq prompt:\n";
print_r($prompt);

$didKey = App\Utils\Env::get('DID_API_KEY', '');
echo "\nDID key prefix: " . substr($didKey, 0, 8) . "...\n";

if (str_starts_with($didKey, 'gsk_')) {
    echo "AVISO: DID_API_KEY parece una clave de Groq, no de D-ID.\n";
}
