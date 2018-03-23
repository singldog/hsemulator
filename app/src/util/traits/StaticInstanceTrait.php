<?php

namespace app\util\traits;

trait StaticInstanceTrait
{
    private function __construct(){}

    public static $instances;
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
