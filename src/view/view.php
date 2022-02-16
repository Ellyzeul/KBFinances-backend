<?php namespace KBFinances\Views;


class View
{
    public static function render(array $response, int $status_code)
    {
        $json = json_encode($response);
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: https://kbfinances.netlify.app");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-type");
        http_response_code($status_code);

        echo $json;
    }
}
