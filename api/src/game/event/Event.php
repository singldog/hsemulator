<?php

namespace app\game\event;

class Event{

    public $source;
    private $datapack;

    public function __construct($source, $datapack){
        $this->source = $source;
        $this->datapack = $datapack;
    }

    public function data($key){
        if(array_key_exists($key, $this->datapack)){
            return $this->datapack[$key];
        }
        throw new Exception('尝试使用不存在的事件数据');
    }

    public function __get($name){
        return $this->data($name);
    }   

}