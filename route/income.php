<?php

header("Access-Control-Allow-Origin: *");

use \KBFinances\Controllers\IncomeController;

require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
$_SESSION["dot_env_path"] = __DIR__.DIRECTORY_SEPARATOR."..";
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config.php";


$request = json_decode(file_get_contents('php://input'), true);

if($_GET["operation"] == "c") {
    IncomeController::create(
        $request["description"],
        $request["value"],
        $request["category"],
        $request["email"],
        $request["receipt_date"]
    );
}
if($_GET["operation"] == "r") {
    IncomeController::read();
}