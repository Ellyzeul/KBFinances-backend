<?php

header("Access-Control-Allow-Origin: *");

use \KBFinances\Controllers\ExpenseController;
use KBFinances\Models\Expense;

require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
$_SESSION["dot_env_path"] = __DIR__.DIRECTORY_SEPARATOR."..";
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config.php";


$request = json_decode(file_get_contents('php://input'), true);

if($_GET["operation"] == "c") {
    ExpenseController::create(
        $request["description"],
        $request["value"],
        $request["category"],
        $request["email"],
        $request["payment_date"],
        $request["due_date"]
    );
    return;
}
if($_GET["operation"] == "r") {
    ExpenseController::read(
        $request["email"],
        $request["month"],
        $request["year"]
    );
    return;
}
if($_GET["operation"] == "u") {
    ExpenseController::update(
        $request["id"],
        $request["description"],
        $request["value"],
        $request["category"],
        $request["email"],
        $request["payment_date"],
        $request["due_date"]
    );
    return;
}
if($_GET["operation"] == "d") {
    ExpenseController::delete(
        $request["id"]
    );
    return;
}
if($_GET["operation"] == "f") {
    ExpenseController::fetchSingle(
        $request["email"],
        $request["id"]
    );
    return;
}
if($_GET["operation"] == "pc") {
    ExpenseController::getGroupByCategory(
        $request["email"],
        $request["month"],
        $request["year"]
    );
    return;
}
if($_GET["operation"] == "get_categories") {
    ExpenseController::getCategories();
    return;
}