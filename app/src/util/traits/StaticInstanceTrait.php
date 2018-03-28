<?php

namespace app\util\traits;

/**
 * 用于使用单利模式或使用多个静态对象
 * 
 * 工具类多数使用此trait，但不适用于需要传参的类
 */
trait StaticInstanceTrait
{

    /**
     * 静态对象
     */
    public static $instances;

    /**
     * 获取静态对象
     * 
     * @param string $instanceName 对象键名，若不存在则创建
     */
    public static function getInstance($instanceName = ''){
        if (!self::$instances) {
            self::$instances = [];
        }
        if(!array_key_exists($instanceName, self::$instances)){
            self::$instances[$instanceName] = new self;
        }
        return self::$instances[$instanceName];
    }
}
