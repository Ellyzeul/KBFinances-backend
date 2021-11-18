<?php namespace KBFinances\Views;


class View
{
    public static function render(array $response, int $status_code)
    {
        $json = json_encode($response);
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($status_code);

        echo $json;
    }
}