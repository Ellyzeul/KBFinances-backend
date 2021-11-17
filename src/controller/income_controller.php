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

        View::render($response);
    }

    public static function read()
    {
        $response = Income::read();

        View::render($response);
    }
}