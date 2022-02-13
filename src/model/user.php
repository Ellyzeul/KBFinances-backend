<?php namespace KBFinances\Models;

use KBFinances\Services\Database;


class User
{
    public static function create(string $name, string $email, string $password)
    {
        $insertQuery =
           "INSERT INTO Usuarios (
               nome,
               email,
               senha
            ) VALUES (?,?,?)";

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        
        $db = Database::getDB();

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param("sss", $name, $email, $hashedPwd);
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "$db->errno: $db->error"
        ];

        return [
            "status" => 201,
            "message" => "Usuário criado com sucesso",
        ];
    }

    public static function getUserID(string $email)
    {
        $selectQuery =
           "SELECT
                id
            FROM Usuarios
            WHERE email = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->bind_result($id);
        $stmt->execute();
        $stmt->fetch();

        return $id;
    }

    public static function getBalance(string $email)
    {
        $selectQuery =
           "SELECT saldo
            FROM Usuarios
            WHERE email = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->bind_result($balance);
        $stmt->execute();
        $stmt->fetch();

        return floatval($balance);
    }
}