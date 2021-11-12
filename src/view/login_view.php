<?php namespace KBFinances\Views;


class LoginView
{
    public static function render($response)
    {
        $json = json_encode($response);
        header('Content-Type: application/json; charset=utf-8');

        echo $json;
    }
}