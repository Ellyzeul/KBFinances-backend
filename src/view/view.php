<?php namespace KBFinances\Views;


use KBFinances\Configs\CORS;

class View
{
    public static function render(array $response, int $status_code)
    {
        $json = json_encode($response);
        header('Content-Type: application/json; charset=utf-8');
        
        CORS::setHeaders($status_code);

        echo $json;
    }
}
