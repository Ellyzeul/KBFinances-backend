<?php namespace KBFinances\Controllers;

use KBFinances\Services\Login;
use KBFinances\Views\LoginView;


class LoginController
{
    public static function auth(string $email, string $pwd)
    {
        $loginResponse = Login::auth($email, $pwd);
        
        if($loginResponse["code"] != 0) $response = [
            "status" => 401,
            "message" => $loginResponse["message"]
        ];

        else $response = [
            "status" => 200,
            "message" => "Login successful",
            "name" => $loginResponse["name"],
            "balance" => $loginResponse["balance"]
        ];

        LoginView::render($response);
    }
}