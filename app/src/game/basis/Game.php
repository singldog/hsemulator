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
            $player->bindGame($this);
        }else if(!$this->player2){
            $this->player2 = $player;
            $player->bindGame($this);
            $this->start();
        }else{
            throw new Exception('游戏人数已满');
        }
    }

    public function start(){
        
    }
}
