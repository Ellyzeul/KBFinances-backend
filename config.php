<?php

if(!isset($_ENV["DB_NAME"])) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SESSION["dot_env_path"]);
    $dotenv->load();
}
header("Access-Control-Allow-Origin: localhost:3000");