<?php namespace KBFinances\Controllers;

use KBFinances\Models\Income;
use KBFinances\Views\View;


class IncomeController
{
    public static function create(
        string $description,
        float $value,
        int $category,
        string $email,
        ?string $receipt_date
    )
    {
        $response = Income::create(
            $description,
            $value,
            $category,
            $email,
            $receipt_date
        );
        $status_code = $response["status"];

        View::render($response, $status_code);
    }

    public static function read(string $email, int $month, int $year)
    {
        $response = Income::read($email, $month, $year);

        View::render($response, 200);
    }

    public static function update(
        int $id, 
        string $description, 
        float $value, 
        int $category,
        string $email,
        ?string $entry_date,
        ?string $receipt_date
    )
    {
        $incomeResponse = Income::update(
            $id,
            $description,
            $value,
            $category,
            $email,
            $entry_date,
            $receipt_date
        );
        
        $response = [
            "message" => $incomeResponse["message"],
            "balance" => (isset($incomeResponse["balance"]) ? $incomeResponse["balance"] : null)
        ];
        $status_code = $incomeResponse["status"];

        View::render($response, $status_code);
    }

    public static function delete(int $id)
    {
        $incomeResponse = Income::delete($id);
        
        $response = [
            "message" => $incomeResponse["message"]
        ];
        $status_code = $incomeResponse["status"];

        View::render($response, $status_code);
    }

    public static function fetchSingle(string $email, int $id)
    {
        $response = Income::fetchSingle($email, $id);

        View::render($response, 200);
    }
    
    public static function setCategory(string $category, string $email)
    {
        $response = Income::setCategory($category, $email);

        View::render($response, 201);
    }

    public static function getCategories(string $email)
    {
        $response = Income::getCategories($email);

        View::render($response, 200);
    }

    public static function deleteCategory(int $code, string $email)
    {
        $response = Income::deleteCategory($code, $email);
        $status_code = $response["status"];
        unset($response["status"]);

        View::render($response, $status_code);
    }
}