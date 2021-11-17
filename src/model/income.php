<?php namespace KBFinances\Models;

use KBFinances\Models\Entry;
use KBFinances\Services\Database;


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

        $insertQuery =
           "INSERT INTO Receitas (
                id,
                categoria,
                data_recebimento
            ) VALUES (?,?,?)";
        
        $db = Database::getDB();

        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param(
            "iis",
            $entryResponse["entry_id"],
            $category,
            $receipt_date
        );
        $stmt->execute();

        if($db->errno != 0) return [
            "status" => 500,
            "message" => "some error happened on Income"
        ];

        return [
            "status" => 200,
            "message" => "Income created"
        ];
    }

    public static function read()
    {
        $selectQuery =
           "SELECT
                descricao AS description,
                valor AS value,
                data_lancamento AS entry_date,
                (SELECT categoria FROM CategoriaDeReceitas WHERE id = Receitas.categoria) AS category,
                data_recebimento AS receipt_date
            FROM Receitas
            INNER JOIN Lancamentos ON Receitas.id = Lancamentos.id";
        
        $db = Database::getDB();

        $result = $db->query($selectQuery);
        $response = [];

        while(($row = $result->fetch_assoc()) != null) {
            array_push($response, $row);
        }

        return $response;
    }
}