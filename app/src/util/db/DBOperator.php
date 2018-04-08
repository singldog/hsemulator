<?php

namespace app\util\db;

class DBOperator{
    use \app\util\traits\StaticInstanceTrait;

    private $manager;

    public function __construct(){
        $this->manager = new \MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

}