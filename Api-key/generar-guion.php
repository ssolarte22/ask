
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

$apiKey = "AIzaSyDTAdifLLcAi52yQhqTtjs8W4b7XCXJHDc";

$prompt = $_POST['prompt'] ?? '';

if ($prompt == '') {
    echo json_encode(["error" => "Prompt vacío"]);
    exit;
}

$data = [
    "contents" => [
        [
            "parts" => [
                [
                    "text" =>
                    "IMPORTANTE: Escribe como si fueras un narrador humano colombiano, con ritmo natural, pausas suaves y sin palabras técnicas" .
                    "Eres un narrador profesional de videos. " .
                    "Escribe SOLO el guion final, sin introducciones, sin títulos, sin explicaciones, sin frases como 'aquí tienes'. " .
                    "El texto debe ser directo y listo para narración en voz en off. " .
                    "La duración es una RESTRICCIÓN estricta. " .
                    "NO menciones la duración en el texto. " .
                    "Tema del video: " . $prompt
                ]
            ]
        ]
    ]
];
$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "x-goog-api-key: $apiKey"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode([
        "error" => "Error CURL",
        "detalle" => curl_error($ch)
    ]);
    exit;
}

curl_close($ch);

$response = json_decode($result, true);

if (!isset($response["candidates"])) {
    echo json_encode([
        "error" => "Gemini no devolvió respuesta válida",
        "debug" => $response
    ]);
    exit;
}

$guion = $response["candidates"][0]["content"]["parts"][0]["text"] ?? null;

if (!$guion) {
    echo json_encode([
        "error" => "No se pudo generar el guion",
        "debug" => $response
    ]);
    exit;
}

// ✅ RESPUESTA FINAL CORRECTA
echo json_encode([
    "guion" => $guion
]);