<?php namespace KBFinances\Models;

use KBFinances\Services\Database;


class Kakeibo
{
    public static function getMonthEconomy(string $email, int $month, int $year)
    {
        $selectQuery =
           "SELECT economia_prevista
            FROM MesDeFinancas
            WHERE
                mes = ? AND
                ano = ? AND
                id_usuario = (SELECT id FROM Usuarios WHERE email = ?)";

        $db = Database::getDB();

        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param("s", $month, $year, $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = $result->fetch_assoc();

        return $response;
    }

    public static function getAnnotation(string $email, int $month, int $year)
    {
        $selectQuery =
           "SELECT anotacao
            FROM MesDeFinancas
            WHERE
                mes = ? AND
                ano = ? AND
                id_usuario = (SELECT id FROM Usuarios WHERE email = ?)";

        $db = Database::getDB();

        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param("s", $month, $year, $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = $result->fetch_assoc();

        return $response;
    }

    public static function setMonthEconomy(string $email, int $economy, int $month, int $year)
    {
        $updateQuery = 
           "UPDATE MesDeFinancas
                SET economia_prevista = ?
            WHERE
                mes = ? AND
                ano = ? AND
                id_usuario = (SELECT id FROM Usuarios WHERE email = ?)";
            
            $db = Database::getDB();

            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("diis", floatval($economy/100), $month, $year, $email);
            $stmt->execute();

            if($db->errno != 0) return [
                "status" => 500,
                "message" => "Erro ao atualizar a economia prevista"
            ];
    
            return [
                "status" => 200,
                "message" => "Economia prevista atualizada"
            ];
    }

    public static function setAnnotation(string $email, string $annotation, int $month, int $year)
    {
        $updateQuery = 
           "UPDATE MesDeFinancas
                SET anotacao = ?
            WHERE
                mes = ? AND
                ano = ? AND
                id_usuario = (SELECT id FROM Usuarios WHERE email = ?)";
            
            $db = Database::getDB();

            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("siis", $annotation, $month, $year, $email);
            $stmt->execute();

            if($db->errno != 0) return [
                "status" => 500,
                "message" => "Erro ao atualizar a anotação mensal"
            ];
    
            return [
                "status" => 200,
                "message" => "Anotação mensal atualizada"
            ];
    }
}