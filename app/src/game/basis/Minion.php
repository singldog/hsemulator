<?php

namespace app\game\basis;

class Minion extends MinionBase{

    public $mana;

    public function __construct($name, $imgUri, $attack, $health, $mana){
        parent::__construct($name, $imgUri, $attack, $health);
        $this->mana = $mana;
    }

    
}
