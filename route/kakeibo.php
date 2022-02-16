<?php

use \KBFinances\Controllers\KakeiboController;

require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
$_SESSION["dot_env_path"] = __DIR__.DIRECTORY_SEPARATOR."..";
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config.php";


$request = json_decode(file_get_contents('php://input'), true);

if(!isset($request["month"])) {
    $date = explode("-", date("m-Y"));
    $month = intval($date[0]);
    $year = intval($date[1]);
    unset($date);
}
else {
    $month = intval($request["month"]);
    $year = intval($request["year"]);
}

if($_GET["operation"] == "set_economy") {
    KakeiboController::setMonthEconomy(
        $request["email"],
        $request["economy"],
        $month,
        $year
    );
}
if($_GET["operation"] == "set_annotation") {
    KakeiboController::setAnnotation(
        $request["email"],
        $request["annotation"],
        $month,
        $year
    );
}
if($_GET["operation"] == "get_economy") {
    KakeiboController::getMonthEconomy(
        $request["email"],
        $month,
        $year
    );
}
if($_GET["operation"] == "get_annotation") {
    KakeiboController::getAnnotation(
        $request["email"],
        $month,
        $year
    );
}
