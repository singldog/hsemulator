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
    public $initCards;

    public const MAX_MANA = 10;

    public $game;
    
    public function __construct($name, $hero, $board, $hand, $deck){
        $this->name = $name;
        $this->hero = $hero;
        $this->board = $board;
        $this->hand = $hand;
        $this->deck = $deck;

        $hero->player = $this;
        $board->player = $this;
        $deck->player = $this;
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

    public function initByGame($firstHand){
        $this->randInitCards($firstHand);
    }

    public function randInitCards($firstHand){
        $cardNum = $firstHand?3:4;
        $this->initCards = array_rand_elem($this->deck->cards, $cardNum);
    }

    public function drawInitCards(){
        $this->drawCards($this->initCards);
    }

    public function drawARandomCard(){
        $card = array_rand_elem($this->deck->cards);
        $this->drawCard($card);
    }

    public function drawCard($card){
        $this->hand->addCard($card);
        $this->deck->removeCard($card);
    }

    public function drawCards($cards){
        foreach($cards as $card){
            $this->drawCard($card);
        }
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
            'inTurn' => $this->inTurn,
            'initCards' => $this->initCards
        ];
    }
    
}
