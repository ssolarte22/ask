<?php

$apiKey = "";
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