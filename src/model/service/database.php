<?php namespace KBFinances\Services;

class Database
{
    private static \mysqli $db;
    
    private static function isLocal()
    {
        return $_SERVER['SERVER_NAME'] == 'localhost' ? true : false;
    }

    public static function getDB()
    {
        if(isset(self::$db)) return self::$db;

        try {
            self::$db = new \mysqli(
                self::isLocal() ? $_ENV["DB_LOCAL_SERVER_NAME"] : $_ENV["DB_SERVER_NAME"],
                self::isLocal() ? $_ENV["DB_LOCAL_USERNAME"] : $_ENV["DB_USERNAME"],
                self::isLocal() ? $_ENV["DB_LOCAL_PASSWORD"] : $_ENV["DB_PASSWORD"],
                self::isLocal() ? $_ENV["DB_LOCAL_NAME"] : $_ENV["DB_NAME"],
                self::isLocal() ? $_ENV["DB_LOCAL_PORT"] : $_ENV["DB_PORT"]
            );
        }
        catch(\Exception $err) {
            echo "Database Error: $err";
        }

        return self::$db;
    }
}