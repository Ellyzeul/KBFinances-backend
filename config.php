<?php

if(!isset($_ENV["DB_NAME"])) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SESSION["dot_env_path"]);
    $dotenv->load();
}
$allowedOrigins = [
    "kbfinances.netlify.app"
];
var_dump($_SERVER);
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    $origin = $_SERVER['HTTP_ORIGIN'];
    $protocol = $_SERVER['HTTP_PROTOCOL'];

    if($origin == 'localhost') {
        $port = $_SERVER['SERVER_PORT'];
        header("Access-Control-Allow-Origin: http://localhost:$port");
    }
    foreach($allowedOrigins as $allowed) {
        if($origin == $allowed) {
            header("Access-Control-Allow-Origin: $protocol://$origin");
        }
    }
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-type");
    http_response_code(204);
    exit;
}