<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

header("Content-Type: application/json; charset=UTF-8");

ob_start();

// Tu API Key de Groq (obtenerla en https://console.groq.com)
// $apiKey = "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";

// Obtener el prompt del POST
$prompt = $_POST['prompt'] ?? '';

if ($prompt == '') {
    echo json_encode(["error" => "Prompt vacío"]);
    exit;
}

$data = [
    "messages" => [
        [
            "role" => "user",
            "content" => "IMPORTANTE: Escribe el guion completamente en español neutro, como si fueras un narrador humano colombiano, con ritmo natural, pausas suaves y sin palabras técnicas. " .
                        "Eres un narrador profesional de videos. " .
                        "Escribe SOLO el guion final, sin introducciones, sin títulos, sin explicaciones, sin frases como 'aquí tienes'. " .
                        "El texto debe ser directo y listo para narración en voz en off en español. " .
                        "NO menciones la duración en el texto. " .
                        "Tema del video: " . $prompt
        ]
    ],
    "model" => "llama-3.3-70b-versatile",
    "temperature" => 0.7,
    "max_tokens" => 400,
];

// URL de Groq
$url = "https://api.groq.com/openai/v1/chat/completions";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $apiKey
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    ob_clean();
    echo json_encode([
        "error" => "Error CURL: " . curl_error($ch),
        "detalle" => "No se pudo conectar a Groq"
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

$response = json_decode($result, true);

// Verificación de errores de la API
if ($httpCode !== 200) {
    ob_clean();
    echo json_encode([
        "error" => "Error HTTP " . $httpCode . " de Groq",
        "detalle" => $response["error"]["message"] ?? substr((string) $result, 0, 500)
    ]);
    exit;
}

if (!is_array($response)) {
    ob_clean();
    echo json_encode([
        "error" => "Groq devolvió una respuesta no JSON",
        "detalle" => substr((string) $result, 0, 500)
    ]);
    exit;
}

// Extraer el texto del guion de la respuesta de Groq
$guion = $response["choices"][0]["message"]["content"] ?? null;

if (!$guion) {
    ob_clean();
    echo json_encode([
        "error" => "No se pudo generar el guion",
        "debug" => $response
    ]);
    exit;
}

ob_clean();
echo json_encode([
    "guion" => trim($guion)
]);
