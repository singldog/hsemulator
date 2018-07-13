<?php

namespace app\game\basis;

class Minion extends Charactor implements IMinionBase{
    use \app\util\traits\AfterBindTrait;

    public $mana;
    public $card;

    public function __construct($name, $imgUri, $attack, $health, $mana, $card){
        parent::__construct($name, $imgUri, $attack, $health);
        $this->mana = $mana;
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
