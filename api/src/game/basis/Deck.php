<?php

namespace app\game\basis;

use app\game\basis\MinionBase;

/**
 * 玩家卡组
 */
class Deck implements IDatable{
    use \app\util\traits\AfterBindTrait;

    /**
     * 该玩家卡组里的卡牌
     */
    public $cards = [];

    public $player;
    

    /**
     * 洗入一张牌
     * 
     * @param Card $card 牌
     */
    public function addCard(Card $card) : void {
        if(!in_array($card, $this->cards, true)){
            $this->cards[] = $card;
            $card->deck = $this;
        }
    }

    /**
     * 删除一张牌
     * 
     * @param Card $card 牌
     */
    public function removeCard(Card $card) : void {
        array_splice($this->cards, array_search($card, $this->cards, true), 1);
        $card->deck = null;
    }

    public function randCard($num){
        $num = min($num, count($this->cards));
        
    }

    /**
     * 导出数据
     */
    public function exportData(){
        return [
            'cardRemain' => count($this->cards)
        ];
    }
}
