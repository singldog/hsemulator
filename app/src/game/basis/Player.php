<?php

namespace app\game\basis;

/**
 * 玩家类
 */
class Player implements IDatable{
    use \app\util\traits\AfterBindTrait;

    public $name;
    public $hero;
    public $board;
    public $hand;
    public $deck;
    public $mana = 0;
    public $manaMax = 1;
    public $inTurn = false;

    public const MAX_MANA = 10;

    /**
     * afterbind:
     * public $game;
     */
    
    public function __construct($name, $hero, $board, $hand, $deck){
        $this->name = $name;
        $this->hero = $hero;
        $this->board = $board;
        $this->hand = $hand;
        $this->deck = $deck;
    }

    public function refillMana(){
        $this->mana = $this->manaMax;
    }

    public function startTurn(){
        $this->manaMax = max($this->manaMax+1, self::MAX_MANA);
        $this->refillMana();
        $this->inTurn = true;
    }

    public function endTurn(){
        $this->inTurn = false;
    }

    public function useMana($manaCost){
        $this->mana -= $manaCost;
    }

    public function drawACard(){
        $index = array_rand($this->deck->cards);
        $card = $this->deck->cards[$index];
        $this->hand->addCard($card);
        $this->deck->removeCard($card);
    }

    public function exportData(){
        return [
            'name' => $this->name,
            'hero' => $this->hero->exportData(),
            'board' => $this->board->exportData(),
            'hand' => $this->hand->exportData(),
            'deck' => $this->deck->exportData(),
            'mana' => $this->mana,
            'manaMax' => $this->manaMax,
            'inTurn' => $this->inTurn
        ];
    }
    
}
