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
}