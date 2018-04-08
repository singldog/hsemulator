<?php

namespace app\util\localize;

/**
 * 使用json本地化数据
 */
class LocalJson implements ILocalize{
    use \app\util\traits\StaticInstanceTrait;

    /** 本地文件地址 */
    public function jsonFile(){
        return "data/".env()."/localized.json";
    }

    public function set($key, $val){
        $result = @file_get_contents($this->jsonFile());
        if($result === false){
            throw new \Exception('未找到指定的缓存文件', 12);
        }
        $data = json_decode($result);
        $data->$key = $val;
        file_put_contents($this->jsonFile(), json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    public function get($key){
        $result = @file_get_contents($this->jsonFile());
        if($result === false){
            throw new \Exception('未找到指定的缓存文件', 12);
        }
        $data = json_decode(file_get_contents($this->jsonFile()))??[];
        if(array_key_exists($key, $data)){
            return $data->$key;
        }
        throw new \Exception('未找到指定的缓存数据', 12);
    }

}
