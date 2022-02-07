<?php namespace KBFinances\Models;

use KBFinances\Services\Database;


class Kakeibo
{
    public static function setMonthEconomy(int $economy, int $month, int $year)
    {
        $updateQuery = 
           "UPDATE MesDeFinancas
                SET economia_prevista = ?
            WHERE
                mes = ? AND
                ano = ?";
            
            $db = Database::getDB();

            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("dii", floatval($economy/100), $month, $year);
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

    public static function setAnnotation(string $annotation, int $month, int $year)
    {
        $updateQuery = 
           "UPDATE MesDeFinancas
                SET anotacao = ?
            WHERE
                mes = ? AND
                ano = ?";
            
            $db = Database::getDB();

            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("sii", $annotation, $month, $year);
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