<?php

namespace app\game\basis;

/**
 * 玩家类
 */
class Player{
    public $name;
    public $hero;
    public $board;
    
    public function __construct($name, $hero, $board){
        $this->name = $name;
        $this->hero = $hero;
        $this->board = $board;
    }
    
}
