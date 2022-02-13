<?php namespace KBFinances\Controllers;

use KBFinances\Models\User;
use KBFinances\Views\View;


class UserController
{
    public static function create(string $name, string $email, string $password)
    {
        $response = User::create(
            $name,
            $email,
            $password
        );
        $status_code = $response["status"];

        View::render($response, $status_code);
    }
}