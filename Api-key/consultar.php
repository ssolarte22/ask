<?php

$apiKey = "dGhlam95bWFya2VyQGdtYWlsLmNvbQ:j4a0E595JNG6hyNXQe-s8";
$id = $_GET['id'];

$url = "https://api.d-id.com/talks/" . $id;

$options = [
    "http" => [
        "header" => "Authorization: Basic " . base64_encode($apiKey . ":"),
        "method" => "GET"
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;

?>