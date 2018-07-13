<?php

namespace app\game\basis;

class MinionCard extends ManaCard{
    
    protected $minionConstructor;
    public $attack;
    public $health;

    public function __construct($name, $imgUri, $desc, $mana, $attack, $health, $minionConstructor){
        parent::__construct($name, $imgUri, $desc, $mana);
        $this->attack = $attack;
        $this->health = $health;
        $this->minionConstructor = $minionConstructor;
    }

    public function play(){
        parent::play();
        $this->spawnMinion();
    }

    public function spawnMinion(){
        $minion = $this->minionConstructor->construct($this);
        $this->hand->player->board->addMinionBase($minion);
    }

    public function exportData(){
        return array_merge(
            parent::exportData(),
            [
                'attack' => $this->attack->exportData(),
                'health' => $this->health->exportData()
            ]
        );
    }


}
