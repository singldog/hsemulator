<?php

namespace app\util\localize;

class LocalJson implements ILocalize{
    use \app\util\traits\StaticInstanceTrait;

    public const JSON_FILE = "data/localized.json";

    public function set($key, $val){
        $result = @file_get_contents(self::JSON_FILE);
        if($result === false){
            throw new \Exception('未找到指定的缓存文件', 12);
        }
        $data = json_decode($result);
        $data->$key = $val;
        file_put_contents(self::JSON_FILE, json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    public function get($key){
        $result = @file_get_contents(self::JSON_FILE);
        if($result === false){
            throw new \Exception('未找到指定的缓存文件', 12);
        }
        $data = json_decode(file_get_contents(self::JSON_FILE));
        if(array_key_exists($key, $data)){
            return $data->$key;
        }
        throw new Exception('未找到指定的缓存数据', 12);
    }

}
