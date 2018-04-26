<?php

namespace app\game\move;

abstract class Move{
    public $player;
    public $datapack;

    public function __construct($player, $datapack){
        $this->player = $player;
        $this->datapack = $datapack;
    }

    public abstract function move();
}