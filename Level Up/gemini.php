<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $input = json_decode(file_get_contents("php://input"), true);
    $message = $input["message"] ?? "";

    $api_key = "AIzaSyCIc0zlp4HLoHpvWGNcBB_aYpHV-zsD7kA"; // replace this with your actual API key

    $payload = json_encode([
        "contents" => [[
            "parts" => [[ "text" => $message ]]
        ]]
    ]);

    $ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$api_key");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    $response = curl_exec($ch);
    curl_close($ch);

// TEMP: show raw response for debugging
    echo $response;
