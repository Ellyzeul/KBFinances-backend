<?php

use \KBFinances\Configs\CORS;

if(!isset($_ENV["DB_NAME"])) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SESSION["dot_env_path"]);
    $dotenv->load();
}

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    CORS::setHeaders(204);
    exit;
}
