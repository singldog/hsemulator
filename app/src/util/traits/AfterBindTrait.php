<?php

namespace app\util\traits;

trait AfterBindTrait{

    public $afterBind = [];

    public function afterBindData($name, $object){
        if(!array_key_exists($name, $this->afterBind)){
            $this->afterBind[$name] = [];
        }
        $this->afterBind[$name][] = $object;
    }

    public function __call(string $name, $arguments){
        if(strpos($name, "bind")===false)
            return;
        if(strlen($name)<=4)
            return;
        $name = str_replace('bind', '', $name);
        $name = lcfirst($name);
        $this->afterBindData($name, $arguments[0]);
    }

    public function __get($key){
        if(!array_key_exists($key, $this->afterBind)){
            throw new \Exception('调用了未绑定的属性');
        }
        $val = $this->afterBind[$key];
        if(count($val)==1){
            return $val[0];
        }else{
            return $val;
        }
    }

}
