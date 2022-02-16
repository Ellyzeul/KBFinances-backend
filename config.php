<?php

if(!isset($_ENV["DB_NAME"])) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SESSION["dot_env_path"]);
    $dotenv->load();
}

$allowed = ["http:/localhost:3000//", "https://kbfinances.netlify.app/"];
$origin = $_SERVER['HTTP_REFERER'];

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if(in_array($origin, $allowed)) header("Access-Control-Allow-Origin: " . substr($origin, 0, -1));
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-type");
    http_response_code(204);
    exit;
}
