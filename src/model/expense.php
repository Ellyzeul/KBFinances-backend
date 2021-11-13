<?php namespace KBFinances\Models;

use KBFinances\Models\Entry;
use KBFinances\Services\Database;


class Expense
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
        Entry::create($description, $value, date("Y-m-d"), $email);

        $insertQuery =
           "INSERT INTO Despesas (
                categoria,
                data_pagamento,
                data_vencimento
            ) VALUES (?,?,?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param(
            "iss",
            $category,
            $payment_date,
            $due_date
        );
        $stmt->execute();

        return [
            "status" => 200,
            "message" => "Expense created"
        ];
    }
}