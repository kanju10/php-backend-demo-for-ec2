<?php
header("Content-Type: application/json");

// Get API key from environment
$apiKey = getenv("OPENAI_API_KEY");

if (!$apiKey) {
    http_response_code(500);
    echo json_encode(["error" => "API key not configured"]);
    exit;
}

// User prompt (for now, hardcoded)
$prompt = "Explain PHP in one sentence";

// OpenAI API endpoint
$url = "https://api.openai.com/v1/chat/completions";

// Request payload
$data = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "user", "content" => $prompt]
    ]
];

// Initialize cURL
$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

// Execute request
$response = curl_exec($ch);

if ($response === false) {
    http_response_code(500);
    echo json_encode(["error" => curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Send AI response back to client
echo $response;