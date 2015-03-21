<?php

class DbConfig
{
    private static $_config = [
        'database' => 'addresses',
        'host'     => 'localhost',
        'charset'  => 'utf8',
        'user'     => 'root',
        'password' => 'root'
    ];

    public static function getDsn()
    {
        $ret = sprintf('mysql:dbname=%s;host=%s;charset=%s',
            self::$_config['database'],
            self::$_config['host'],
            self::$_config['charset']);
        return $ret;
    }

    public static function getUser()
    {
        return self::$_config['user'];
    }

    public static function getPassword()
    {
        return self::$_config['password'];
    }

}