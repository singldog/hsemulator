<?php

namespace app\util\traits;

trait AfterBindTrait{

    public $afterBind;

    public function bind($object){
        $this->afterBind[$object.getClass()] = $object;
    }

}
