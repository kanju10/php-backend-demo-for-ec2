<?php
// This tells the browser that we are sending JSON
header("Content-Type: application/json");

// Simple backend response
$response = [
    "status" => "success",
    "message" => "Hello from PHP backend!",
    "server_time" => date("Y-m-d H:i:s")
];

// Send response to browser
echo json_encode($response);
