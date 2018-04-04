<?php

namespace app\game\basis;

class ManaCard extends Card{

    public $mana;

    public function __construct($name, $imgUri, $desc, $mana){
        parent::__construct($name, $imgUri, $desc);
        $this->mana = $mana;
    }

    public function play(){
        parent::play();
        $this->hand->player->game->costMana($this->mana);
    }

    public function exportData(){
        return array_merge(
            parent::exportData(),
            [ 'mana' => $this->mana->exportData() ]
        );
    }

}
