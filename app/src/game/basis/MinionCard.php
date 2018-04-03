<?php

namespace app\game\basis;

class MinionCard extends Card{
    
    public function __construct($name, $imgUri, $desc, $mana, $player){
        parent::__construct($name, $imgUri, $desc, $player);
        $this->mana = $mana;
    }

    public function play(){
        parent::play();
    }

    public function spawnMinion(){
        
    }

}
