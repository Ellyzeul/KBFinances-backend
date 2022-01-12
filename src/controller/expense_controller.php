<?php namespace KBFinances\Controllers;

use KBFinances\Models\Expense;
use KBFinances\Views\View;


class ExpenseController
{
    public static function create(
        string $description,
        float $value,
        int $category,
        string $email,
        ?string $payment_date,
        ?string $due_date
    )
    {
        $response = Expense::create(
            $description,
            $value,
            $category,
            $email,
            $payment_date,
            $due_date
        );

        View::render($response, 200);
    }

    public static function read()
    {
        $response = Expense::read();

        View::render($response, 200);
    }

    public static function update(
        int $id, 
        string $description, 
        float $value, 
        int $category,
        string $email,
        ?string $payment_date,
        ?string $due_date
    )
    {
        $expenseResponse = Expense::update(
            $id,
            $description,
            $value,
            $category,
            $email,
            $payment_date,
            $due_date
        );
        
        $response = [
            "message" => $expenseResponse["message"],
            "balance" => (isset($expenseResponse["balance"]) ? $expenseResponse["balance"] : null)
        ];
        $status_code = $expenseResponse["status"];

        View::render($response, $status_code);
    }

    public static function delete(int $id)
    {
        $expenseResponse = Expense::delete($id);
        
        $response = [
            "message" => $expenseResponse["message"]
        ];
        $status_code = $expenseResponse["status"];

        View::render($response, $status_code);
    }

    public static function fetchSingle(int $id)
    {
        $response = Expense::fetchSingle($id);

        View::render($response, 200);
    }
}