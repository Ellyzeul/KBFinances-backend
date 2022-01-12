<?php namespace KBFinances\Models;

use KBFinances\Services\Database;
use KBFinances\Models\User;


class Entry
{
    public static function create(string $description, float $value, string $entry_date, string $email)
    {
        $insertQuery =
           "INSERT INTO Lancamentos (
                descricao,
                valor,
                data_lancamento
            ) VALUES (?,?,?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param(
            "sds",
            $description,
            $value,
            $entry_date
        );
        $stmt->execute();

        if($db->errno == 1644) {
            self::insertFinanceMonth($entry_date, $email);
            Entry::create($description, $value, $entry_date, $email);
        }
        if($db->errno != 0) return ["code" => 1];

        return [
            "code" => 0,
            "entry_id" => $db->insert_id
        ];
    }

    public static function update(int $id, string $description, float $value)
    {
        $updateQuery =
           "UPDATE Lancamentos
            SET
                descricao = ?,
                valor = ?
            WHERE id = ?";
        
        $db = Database::getDB();

        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param("sdi", $description, $value, $id);
        $stmt->execute();

        if($db->errno != 0) return ["code" => 1];

        return ["code" => 0];
    }

    public static function delete(int $id)
    {
        $deleteQuery = "DELETE FROM Lancamentos WHERE id = ?";

        $db = Database::getDB();

        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($db->errno != 0) return ["code" => 1];

        return ["code" => 0];
    }

    private static function insertFinanceMonth(string $entry_date, string $email)
    {
        $insertMonthQuery =
           "INSERT INTO MesDeFinancas (
                mes,
                ano,
                id_usuario
            ) VALUES (?,?,?)";

        $db = Database::getDB();
        $month = date("m",strtotime($entry_date));
        $year = date("Y",strtotime($entry_date));
        $user_id = User::getUserID($email);

        $stmt = $db->prepare($insertMonthQuery);
        $stmt->bind_param(
            "iii",
            $month,
            $year,
            $user_id
        );
        $stmt->execute();
    }
}