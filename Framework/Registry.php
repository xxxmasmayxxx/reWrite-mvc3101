<?php


namespace Framework;


abstract class Registry
{
private static $object = [];

    static function set($key, $value)
    {
        self::$object[$key] = $value;
    }

    static function get($key)
    {
        if (isset(self::$object[$key]))
        {
            return self::$object[$key];
        }
        return null;
    }
}