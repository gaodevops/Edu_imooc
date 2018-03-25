<?php


namespace Driver\Cache;
use Config;

class Redis
{
    private static $write_handle = null;
    private static $read_handle = null;

    public static function getWrite()
    {
        $option = array(
            'host' => Config::get('cache.REDIS_W_HOST') ?? '127.0.0.1',
            'port' => Config::get('cache.REDIS_W_PORT') ?? 6379,
        );

        if (!self::$write_handle){
            self::$write_handle = new \Redis();
            self::$write_handle->connect($option['host'], $option['port']);
        }
        return self::$write_handle;
    }

    public static function getRead()
    {

        $option = array(
            'host' => Config::get('cache.REDIS_R_HOST') ?? '127.0.0.1',
            'port' => Config::get('cache.REDIS_R_PORT') ?? 6379,
        );

        if (!self::$read_handle){
            self::$read_handle = new \Redis();
            self::$read_handle->connect($option['host'], $option['port']);
        }
        return self::$read_handle;
        
    }

    public static function set($key, $value, $expire=0)
    {
        if (!self::getWrite()) return false;
        if ($expire == 0) {
            return self::getWrite()->set($key,$value);
        }else{
            return self::getWrite()->setex($key,$expire,$value);
        }
    }

    public static function get($key)
    {
        $func = is_array($key)?'mget':'get';
        return self::getRead()->{$func}($key);
    }

    public static function incr($key ,$number = 1)
    {
        if (!self::getWrite()) return false;
        if ($number == 1){
            return self::getWrite()->incr($key);
        }else{
            return self::getWrite()->incrBy($key,$number);
        }
        
    }

    public static function strlen($key)
    {
        return self::getRead()->strlen($key);
    }


    public static function hset($key,$field,$value)
    {
        return self::getWrite()->hSet($key,$field,$value);
    }

    public static function hget($key,$field = '')
    {
        if (empty($field)){
            return self::getRead()->hGetAll($key);
        }else{
            return self::getRead()->hGet($key,$field);
        }
    }

    public static function hlen($key)
    {
        return self::getRead()->hLen($key);
    }

    public static  function hincrby($key,$field,$number = 1)
    {
        return self::getWrite()->hIncrBy($key,$field,$number);
    }


}