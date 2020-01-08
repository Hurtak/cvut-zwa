<?php

require "../src/app.php";

header("Content-Type: application/json");

if (!isset($_GET["username"])) {
    http_response_code(400);
    echo json_encode([
        "error" => "Missing username field in request data"
    ]);
    exit();
}

$usernameAvailable = !$db->userExists($_GET["username"]);
http_response_code(200);
echo json_encode([
    "usernameAvailable" => $usernameAvailable
]);
