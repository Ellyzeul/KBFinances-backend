<?php namespace KBFinances\Controllers;

use KBFinances\Models\Kakeibo;
use KBFinances\Views\View;


class KakeiboController
{
    public static function setMonthEconomy(int $economy, int $month, int $year)
    {
        $response = Kakeibo::setMonthEconomy(
            $economy, 
            $month, 
            $year
        );
        $status_code = $response["status"];

        View::render($response, $status_code);
    }

    public static function setAnnotation(string $annotation, int $month, int $year)
    {
        $response = Kakeibo::setAnnotation(
            $annotation, 
            $month, 
            $year
        );
        $status_code = $response["status"];

        View::render($response, $status_code);
    }
}