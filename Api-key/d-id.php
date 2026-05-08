<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$apiKey = "dGhlam95bWFya2VyQGdtYWlsLmNvbQ:j4a0E595JNG6hyNXQe-s8";

if (!isset($_POST['prompt']) || empty($_POST['prompt'])) {
    echo json_encode(["error" => "Prompt vacío"]);
    exit;
}

$prompt = $_POST['prompt'];

$url = "https://api.d-id.com/talks";

$data = [
    "script" => [
        "type" => "text",
        "input" => $prompt
    ],
    "driver_id" => "uU0tQ1l9x7"
];

$options = [
    "http" => [
        "header"  => "Content-Type: application/json\r\n" .
                     "Authorization: Basic " . base64_encode($apiKey . ":"),
        "method"  => "POST",
        "content" => json_encode($data),
        "ignore_errors" => true 
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;