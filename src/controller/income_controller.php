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
        $incomeResponse = Income::create(
            $description,
            $value,
            $category,
            $email,
            $receipt_date
        );
        
        $response = [
            "message" => $incomeResponse["message"]
        ];
        $status_code = $incomeResponse["status"];

        View::render($response, $status_code);
    }

    public static function read(string $email)
    {
        $response = Income::read($email);

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

    public static function fetchSingle(int $id)
    {
        $response = Income::fetchSingle($id);

        View::render($response, 200);
    }
}