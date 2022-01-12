<?php namespace KBFinances\Models;

use KBFinances\Models\Entry;
use KBFinances\Services\Database;
use KBFinances\Models\User;


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
            "status" => 201,
            "message" => "Expense created",
            "balance" => User::getBalance($email)
        ];
    }

    public static function read()
    {
        $selectQuery =
           "SELECT
                descricao AS description,
                valor AS value,
                data_lancamento AS entry_date,
                categoria AS category,
                data_pagamento AS payment_date,
                data_vencimento AS due_date
            FROM Despesas
            INNER JOIN Lancamentos ON Despesas.id = Lancamentos.id";
        
        $db = Database::getDB();

        $result = $db->query($selectQuery);
        $response = [];

        while(($row = $result->fetch_assoc()) != null) {
            array_push($response, $row);
        }

        return $response;
    }

    public static function update(
        int $id, 
        string $description, 
        float $value, 
        int $category,
        ?string $payment_date,
        ?string $due_date
    )
    {
        $entryResponse = Entry::update($id, $description, $value);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => "some error happened on Entry"
        ];

        $updateQuery =
           "UPDATE Despesas
            SET
                categoria = ?,
                data_pagamento = ?,
                data_vencimento = ?
            WHERE id = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param("issi", $category, $payment_date, $due_date, $id);
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "some error happened on Expense"
        ];

        return [
            "status" => 200,
            "message" => "expense updated"
        ];
    }
}