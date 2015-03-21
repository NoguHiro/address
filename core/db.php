<?php

class Db
{

    private static $_pdo = null;

    public static function connect()
    {
        if (self::$_pdo instanceof PDO) {
            return self::$_pdo;
        }
        // データベースに接続
        return self::$_pdo = new PDO(
            DbConfig::getDsn(),
            DbConfig::getUser(),
            DbConfig::getPassword(),
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            )
        );
    }

}