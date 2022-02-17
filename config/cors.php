<?php namespace KBFinances\Configs;


class CORS
{
    private static array $allowed = [
        "http://localhost:3000/",
        "https://kbfinances.netlify.app/"
    ];

    public static function setHeaders(int $status_code)
    {
        $origin = $_SERVER['HTTP_REFERER'];

        if(in_array($origin, $allowed)) {
            $origin = substr($origin, 0, -1);
            header("Access-Control-Allow-Origin: $origin");
        }
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-type");
        http_response_code($status_code);
    }
}
