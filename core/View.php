<?php
/**
 * Created by PhpStorm.
 * User: noguhiro
 * Date: 15/03/22
 * Time: 3:31
 */

class View
{
    private static $_stack = [];

    public static function load($file, array $data = [])
    {
        $fileName = VIEW_PATH . $file . '.php';
        if (!file_exists($fileName)) {
            throw new RuntimeException($file . 'が見つかりません');
        }
        self::$_stack[$fileName] = $data;
    }

    public static function getStack()
    {
        return self::$_stack;
    }

}