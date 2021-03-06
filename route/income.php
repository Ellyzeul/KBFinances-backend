<?php

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
    IncomeController::read(
        $request["email"],
        $request["month"],
        $request["year"]
    );
}
if($_GET["operation"] == "u") {
    IncomeController::update(
        $request["id"],
        $request["description"],
        $request["value"],
        $request["category"],
        $request["email"],
        $request["entry_date"],
        $request["receipt_date"]
    );
}
if($_GET["operation"] == "d") {
    IncomeController::delete(
        $request["id"]
    );
}
if($_GET["operation"] == "f") {
    IncomeController::fetchSingle(
        $request["email"],
        $request["id"]
    );
}
if($_GET["operation"] == "create_category") {
    IncomeController::setCategory(
        $request["category"],
        $request["email"]
    );
}
if($_GET["operation"] == "get_categories") {
    IncomeController::getCategories(
        $request["email"]
    );
}
if($_GET["operation"] == "delete_category") {
    IncomeController::deleteCategory(
        $request["code"],
        $request["email"]
    );
}
