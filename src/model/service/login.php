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
           "CALL select_login(?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if(!isset($result["name"])) return [
            "code" => 1,
            "message" => "Email não encontrado..."
        ];

        if(password_verify($pwd, $result["password"])) return [
            "name" => $result["name"],
            "balance" => $result["balance"],
            "economy" => $result["economy"] ? $result["economy"]*100 : 0,
            "annotation" => $result["annotation"] ? $result["annotation"] : "",
            "code" => 0
        ];

        return [
            "code" => 2,
            "message" => "Senha incorreta..."
        ];
    }
}