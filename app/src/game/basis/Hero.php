<?php

namespace app\game\basis;

/**
 * 英雄类
 */
class Hero extends Charactor{

    /** 技能 */
    public $heroPower;

    public function __construct($name, $imgUri, $attack, $health, $heroPower){
        parent::__construct($name, $imgUri, $attack, $health);
        $this->heroPower = $heroPower;
    }
    
    public function exportData(){
        return array_merge(
            parent::exportData(),
            [ 
                'heroPower' => $this->heroPower->exportData(),
            ]
        );
    }

}
