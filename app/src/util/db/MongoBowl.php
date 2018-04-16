<?php

namespace app\util\db;

class MongoBowl{
    use \app\util\traits\StaticInstanceTrait;

    public $mongo;

    public function __construct(){
        $str = 'mongodb://'.
        conf('username', 'db').':'.
        conf('password', 'db').'@'.
        conf('host', 'db').'.hse';
        $this->mongo = new \MongoDB\Driver\Manager();
    }
}
