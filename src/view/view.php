<?php namespace KBFinances\Views;


class View
{
    public static function render(array $response, int $status_code)
    {
        $json = json_encode($response);
        header('Content-Type: application/json; charset=utf-8');
        
        $allowed = ["http:/localhost:3000/", "https://kbfinances.netlify.app/"];
        $origin = $_SERVER['HTTP_REFERER'];

        if(in_array($origin, $allowed)) header("Access-Control-Allow-Origin: $origin");
        header("Access-Control-Allow-Origin: https://kbfinances.netlify.app");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-type");
        http_response_code($status_code);

        echo $json;
    }
}
