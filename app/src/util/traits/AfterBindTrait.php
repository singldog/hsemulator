<?php

namespace app\util\traits;

/**
 * 用于创建后的绑定
 * 即：创建一个随从后为其绑定至board
 */
trait AfterBindTrait{

    /**
     * 用于保存绑定的数据
     */
    public $afterBind = [];

    /**
     * 绑定数据
     * @param string $name 物体名称
     * @param object|mixed $object 需要绑定的数据
     */
    public function afterBindData(string $name, $object) : void{
        if(!array_key_exists($name, $this->afterBind)){
            $this->afterBind[$name] = [];
        }
        $this->afterBind[$name][] = $object;
    }

    /**
     * 删除绑定的数据
     * @param string $name 物体名称
     */
    public function removeBindData(string $name) : void{
        if(array_key_exists($name, $this->afterBind)){
            unset($this->afterBind[$name]);
        }
    }

    /**
     * 举例：$binder->bindUser($user) 等同于 $binder->afterBindData('user', $user);
     * 若调用的并非此格式名称的方法，则不会发生任何事
     * @param string $name 调用的方法名称
     * @param array $arguments 传入的参数
     */
    public function __call(string $name, $arguments) : void{
        if(strpos($name, "bind")===0){
            $name = str_replace('bind', '', $name);
            $name = lcfirst($name);
            $this->afterBindData($name, $arguments[0]);
            return;
        }else if(strpos($name, "remove")===0){
            $name = str_replace('bind', '', $name);
            $name = lcfirst($name);
            $this->removeBindData($name);
            return;
        }
    }

    /**
     * @param string $key 属性名称
     */
    public function __get($key){
        if(!array_key_exists($key, $this->afterBind)){
            //throw new \Exception('调用了未绑定的属性');
            return;
        }
        $val = $this->afterBind[$key];
        if(count($val)==1){
            return $val[0];
        }else{
            return $val;
        }
    }

}
