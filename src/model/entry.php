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

        $stmt = $db->prepare($insertMonthQuery);
        $stmt->bind_param(
            "sds",
            $month,
            $year,
            User::getUserID($email)
        );
        $stmt->execute();
    }
}