<?php namespace KBFinances\Views;


class View
{
    public static function render($response)
    {
        $json = json_encode($response);
        http_response_code(200);

        echo $json;
    }
}