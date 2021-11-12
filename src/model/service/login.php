<?php namespace KBFinances\Services;

use KBFinances\Services\Database;

class Login
{
    public static function auth(string $email, string $pwd)
    {
        $selectQuery =
           "SELECT
                nome,
                senha
            FROM
                Usuarios
            WHERE
                email = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->bind_result($name, $hashPwd);
        $stmt->execute();
        $stmt->fetch();

        if(!isset($name)) return [
            "code" => 1,
            "message" => "email not found..."
        ];

        if(password_verify($pwd, $hashPwd)) return [
            "code" => 0,
            "name" => $name
        ];

        return [
            "code" => 2,
            "message" => "incorrect password..."
        ];
    }
}