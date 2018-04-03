<?php

namespace app\game\basis;

/**
 * 英雄类
 */
class Hero extends Charactor{

    /** 技能 */
    public $heroPower;

    public function __construct($name, $imgUri, $attack, $health, $heroPower){
        parent::__construct($name, $imgUri);
        $this->heroPower = $heroPower;
    }
    

}
