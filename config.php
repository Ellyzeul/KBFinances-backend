<?php

if(!isset($_ENV["DB_NAME"])) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SESSION["dot_env_path"]);
    $dotenv->load();
}

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-type");
    http_response_code(204);
    exit;
}