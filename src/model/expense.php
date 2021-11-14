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
        $entryResponse = Entry::create($description, $value, date("Y-m-d"), $email);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => "some error happened on Entry"
        ];

        $insertQuery =
           "INSERT INTO Despesas (
                id,
                categoria,
                data_pagamento,
                data_vencimento
            ) VALUES (?,?,?,?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param(
            "iiss",
            $entryResponse["entry_id"],
            $category,
            $payment_date,
            $due_date
        );
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "some error happened on Expense"
        ];

        return [
            "status" => 200,
            "message" => "Expense created"
        ];
    }
}