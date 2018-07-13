<?php

namespace app\game\basis;

class Character extends GameObject{

    public $attack;
    public $health;

    public function __construct($name, $imgUri, $attack, $health){
        parent::__construct($name, $imgUri);
        $this->attack = $attack;
        $this->health = $health;
    }

    public function exportData(){
        return array_merge(
            parent::exportData(),
            [ 
                'attack' => $this->attack->exportData(),
                'health' => $this->health->exportData(),
            ]
        );
    }

}

