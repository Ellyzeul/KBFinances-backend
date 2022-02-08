<?php namespace KBFinances\Controllers;

use KBFinances\Models\Kakeibo;
use KBFinances\Views\View;


class KakeiboController
{
    public static function getMonthEconomy(string $email, int $month, int $year)
    {
        $response = Kakeibo::getMonthEconomy(
            $email,
            $month,
            $year
        );

        View::render($response, 200);
    }
    
    public static function getAnnotation(string $email, int $month, int $year)
    {
        $response = Kakeibo::getAnnotation(
            $email,
            $month,
            $year
        );

        View::render($response, 200);
    }

    public static function setMonthEconomy(string $email, int $economy, int $month, int $year)
    {
        $response = Kakeibo::setMonthEconomy(
            $email,
            $economy, 
            $month, 
            $year
        );
        $status_code = $response["status"];

        View::render($response, $status_code);
    }

    public static function setAnnotation(string $email, string $annotation, int $month, int $year)
    {
        $response = Kakeibo::setAnnotation(
            $email,
            $annotation, 
            $month, 
            $year
        );
        $status_code = $response["status"];

        View::render($response, $status_code);
    }
}