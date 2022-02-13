<?php namespace KBFinances\Models;

use KBFinances\Models\Entry;
use KBFinances\Services\Database;
use KBFinances\Models\User;


class Income
{
    public static function create(
        string $description,
        float $value,
        int $category,
        string $email,
        ?string $receipt_date
    )
    {
        $entryResponse = Entry::create($description, $value, date("Y-m-d"), $email);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => "some error happened on Entry"
        ];

        $selectUserIdQuery = "SELECT get_user_id(?)";

        $db = Database::getDB();

        $stmt = $db->prepare($selectUserIdQuery);
        $stmt->bind_param("s", $email);
        $stmt->bind_result($userId);
        $stmt->execute();
        $stmt->fetch();
        unset($stmt);

        $insertQuery =
           "INSERT INTO Receitas (
                id,
                categoria,
                data_recebimento,
                id_usuario
            ) VALUES (?,?,?,?)";

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param(
            "iisi",
            $entryResponse["entry_id"],
            $category,
            $receipt_date,
            $userId
        );
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "$db->errno: $db->error"
        ];

        return [
            "status" => 201,
            "message" => "Income created",
            "id" => $entryResponse["entry_id"],
            "balance" => User::getBalance($email)
        ];
    }

    public static function read(string $email)
    {
        $selectQuery = "CALL read_incomes(?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
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
        ?string $entry_date,
        ?string $receipt_date
    )
    {
        $entryResponse = Entry::update($id, $description, $value);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => "some error happened on Entry"
        ];

        $updateQuery =
           "UPDATE Receitas
            SET
                categoria = ?,
                data_recebimento = ?
            WHERE id = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param("isi", $category, $receipt_date, $id);
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "some error happened on Income"
        ];

        return [
            "status" => 200,
            "message" => "income updated",
            "balance" => User::getBalance($email)
        ];
    }

    public static function delete(int $id)
    {
        $deleteQuery = "DELETE FROM Receitas WHERE id = ?";

        $db = Database::getDB();

        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "some error happened on Income"
        ];

        $entryResponse = Entry::delete($id);

        if($entryResponse["code"] != 0) return [
            "status" => 500,
            "message" => "some error happened on Entry"
        ];

        return [
            "status" => 200,
            "message" => "income deleted"
        ];
    }

    public static function fetchSingle(string $email, int $id)
    {
        $selectQuery = "CALL fetch_income(?,?)";
        
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

    public static function setCategory(string $category, string $email)
    {
        $insertQuery =
           "INSERT INTO CategoriaDeReceitas (
               categoria,
               id_usuario
            ) VALUES (?,get_user_id(?))";
        
        $db = Database::getDB();

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param("ss", $category, $email);
        $stmt->execute();

        return [
            "message" => "Categoria inserida com sucesso!"
        ];
    }

    public static function getCategories(string $email) {
        $selectQuery =
           "SELECT
                codigo AS code,
                categoria AS category
            FROM CategoriaDeReceitas
            WHERE id_usuario = get_user_id(?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $response = [];

        while(($row = $result->fetch_assoc()) != null) array_push($response, $row);

        return $response;
    }
}