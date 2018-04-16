<?php

namespace app\game\basis;

/**
 * 游戏类
 */
class Game implements IDatable{
    public $player1;
    public $player2;

    public function addPlayer($player){
        if(!$this->player1){
            $this->player1 = $player;
            $player->game = $this;
        }else if(!$this->player2){
            $this->player2 = $player;
            $player->game = $this;
            $this->start();
        }else{
            throw new Exception('游戏人数已满');
        }
    }

    public function start(){
        
    }
}
