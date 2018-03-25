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

    // list


    /**
     * 左侧如队列
     * @param $key
     * @param $value
     * @return int
     */
    public static function lpush($key,$value) {
        if (!self::getWrite()) return false;
        return self::getWrite()->lPush($key,$value);
    }
//    public static function lpushx($key,$value) {
//        return self::getWrite()->lPushx($key,$value);
//    }

//    /**
//     * 右侧如队列
//     * @param $key
//     * @param $value
//     * @return int
//     */
//    public static function rpush($key,$value) {
//        if (!self::getWrite()) return false;
//        if (!self::getWrite()) return false;
//        return self::getWrite()->rPush($key,$value);
//    }
//    public static function rpushx($key,$value) {
//        if (!self::getWrite()) return false;
//        return self::getWrite()->rPushx($key,$value);
//    }


    /**
     * 左侧出队列
     * @param $key
     */
//    public static function lpop($key) {
//        return self::getRead()->lPop($key);
//    }
    /**
     * 右侧出队列
     * @param $key
     */
    public static function rpop($key) {
        return self::getRead()->rPop($key);
    }

    public static function llen($key) {
        return self::getRead()->lLen($key);
    }


    /**
     * 插入集合
     * @param $key
     * @param $value
     * @return int
     */
    public static function sadd($key,$value) {
        if (!self::getWrite()) return false;

        return self::getWrite()->sAdd($key,$value);
    }


    /**
     * 移除集合中的指定元素
     * @param $key
     * @param $value
     */
    public static function sremove($key, $value) {
        if (!self::getWrite()) return false;

        return self::getWrite()->sRemove($key,$value);
    }


    /**
     * 获取指定集合的所有元素
     * @param $key
     * @return array
     */
    public static function smembers($key) {
        return self::getRead()->sMembers($key);
    }

    //获得集合中元素的个数
    public static function scard($key) {
        return self::getRead()->sCard($key);
    }

    //取差
    public static function sdiff($key1,$key2) {
        return self::getRead()->sDiff($key1,$key2);
    }

    //交集
    public static function sinter($key1,$key2) {
        return self::getRead()->sInter($key1,$key2);
    }

    //取并集
    public static function sunion($key1,$key2) {
        return self::getRead()->sUnion($key1,$key2);
    }


    //zset
    public static function zadd($key,$score,$value) {
        if (!self::getWrite()) return false;

        return self::getWrite()->zAdd($key,$score,$value);
    }

    //获取元素的分数

    public static function zscore($key,$value) {
        return self::getRead()->zScore($key,$value);
    }

    //删除元素
    public static function zdelete($key,$value) {
        return self::getRead()->zDelete($key,$value);
    }

    //获取集合中元素的个数
    public static function zsize($key) {
        return self::getRead()->zSize($key);
    }

    //获获取排名在某个范围的元素  从小到大排列，，等同于权重。1最向前
    public static function zrange($key,$start,$end,$withscores = true) {
        return self::getRead()->zRange($key,$start,$end, $withscores);
    }

    public static function zrevrange($key,$start,$end,$withscores = true) {
        return self::getRead()->zRevRange($key,$start,$end, $withscores);
    }



}