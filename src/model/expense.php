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
        $entryResponse = Entry::create($description, $value, date("Y-m-d"), $payment_date, $email);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => $entryResponse["message"]
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
            "id" => $entryResponse["entry_id"],
            "balance" => User::getBalance($email)
        ];
    }

    public static function read(string $email, int $month, int $year)
    {
        $selectQuery = "CALL read_expenses(?,?,?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("sii", $email, $month, $year);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = [];

        while(($row = $result->fetch_assoc()) != null) {
            $row["id"] = intval($row["id"]);
            $row["value"] = floatval($row["value"]);
            array_push($response, $row);
        }

        return $response;
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
            "message" => "expense updated",
            "balance" => User::getBalance($email)
        ];
    }

    public static function delete(int $id)
    {
        $deleteQuery = "DELETE FROM Despesas WHERE id = ?";

        $db = Database::getDB();

        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "some error happened on Expense"
        ];

        $entryResponse = Entry::delete($id);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => "some error happened on Entry"
        ];

        return [
            "status" => 200,
            "message" => "expense deleted"
        ];
    }

    public static function fetchSingle(string $email, int $id)
    {
        $selectQuery = "CALL fetch_expense(?,?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("si", $email, $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = [];

        while(($row = $result->fetch_assoc()) != null) {
            array_push($response, $row);
        }

        return $response;
    }

    public static function getGroupByCategory(string $email, int $month, int $year)
    {
        $selectQuery = "CALL get_expenses_by_category(?,?,?)";
            
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("sii", $email, $month, $year);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = [];

        while(($row = $result->fetch_assoc()) != null) {
            array_push($response, $row);
        }

        return $response;
    }

    public static function getCategories()
    {
        $selectQuery =
           "SELECT
                id,
                categoria
            FROM CategoriaDeDespesas";
        
        $db = Database::getDB();

        $result = $db->query($selectQuery);
        $response = [];

        while(($row = $result->fetch_assoc())) array_push($response, $row);

        return $response;
    }
}