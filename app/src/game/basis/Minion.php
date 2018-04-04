<?php

namespace app\game\basis;

class Minion extends MinionBase{

    public $mana;
    public $attack;
    public $health;

    public function __construct($name, $imgUri, $mana, $attack, $health){
        parent::__construct($name, $imgUri);
        $this->mana = $mana;
        $this->attack = $attack;
        $this->health = $health;
    }

}
