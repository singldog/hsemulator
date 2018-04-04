<?php

namespace app\game\basis;

class Minion extends Charactor implements IMinionBase{
    use \app\util\traits\AfterBindTrait;

    public $mana;
    public $attack;
    public $health;
    public $card;

    public function __construct($name, $imgUri, $mana, $attack, $health, $card){
        parent::__construct($name, $imgUri);
        $this->mana = $mana;
        $this->attack = $attack;
        $this->health = $health;
        $this->card = $card;
    }

    public function exportData(){
        return array_merge(
            parent::exportData(),
            [
                'mana' => $this->mana,
                'attack' => $this->attack,
                'health' => $this->health
            ]
        );
    }

}
