<?php namespace KBFinances\Services;

use KBFinances\Services\Database;

class Login
{
    /**
     * Returns a associative array with a code.
     * 
     * code = 0 -> Authentication successful
     * 
     * code = 1 -> Email not found
     * 
     * code = 2 -> incorrect password
     */
    public static function auth(string $email, string $pwd)
    {
        $selectQuery =
           "SELECT
                nome,
                senha,
                saldo
            FROM
                Usuarios
            WHERE
                email = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->bind_result($name, $hashPwd, $balance);
        $stmt->execute();
        $stmt->fetch();

        if(!isset($name)) return [
            "code" => 1,
            "message" => "Email não encontrado..."
        ];

        if(password_verify($pwd, $hashPwd)) return [
            "code" => 0,
            "name" => $name,
            "balance" => $balance
        ];

        return [
            "code" => 2,
            "message" => "Senha incorreta..."
        ];
    }
}