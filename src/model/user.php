<?php namespace KBFinances\Models;

use KBFinances\Services\Database;


class User
{
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
}