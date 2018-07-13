<?php

namespace app\game\render;

class AttackAlter extends ChainedRender{

    private $alterNum = 0;

    public function __construct($alterNum){
        $this->alterNum = $alterNum;
    }

    public function renderData($data){
        $data->attack += $this->alterNum;
        return $data;
    }

}