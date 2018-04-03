<?php

namespace app\game\basis;

class ManaCard extends Card{

    public $mana;

    public function __construct($name, $imgUri, $desc, $mana, $player){
        parent::__construct($name, $imgUri, $desc, $player);
        $this->mana = $mana;
    }

    public function play(){
        parent::play();
        $this->hand->player->game->costMana($this->mana);
    }

}
