<?php namespace KBFinances\Controllers;

use KBFinances\Services\Login;
use KBFinances\Views\View;


class LoginController
{
    private static function getPropertyByCodeError(int $code)
    {
        if($code == 1) return "email";
        if($code == 2) return "password";
    }

    public static function auth(string $email, string $pwd)
    {
        $loginResponse = Login::auth($email, $pwd);
        
        if($loginResponse["code"] != 0) {
            $response = [
                "property" => LoginController::getPropertyByCodeError($loginResponse["code"]),
                "message" => $loginResponse["message"]
            ];
            $status_code = 401;
        }

        else {
            $response = $loginResponse;
            unset($response["code"]);
            $response["message"] = "Login concluído";
            $status_code = 200;
        }

        View::render($response, $status_code);
    }
}