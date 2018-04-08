<?php

namespace app\game\basis;

/**
 * 某一玩家的手牌
 */
class Hand implements IDatable{
    use \app\util\traits\AfterBindTrait;

    /**
     * 该玩家的所有手牌
     */
    public $cards = [];

    /**
     * afterbind:
     * public $player;
     */

    /**
     * 添加手牌
     * 
     * @param Card $card 牌
     */
    public function addCard(Card $card) : void {
        if(!in_array($card, $this->cards, true)){
            $this->cards[] = $card;
        }
    }

    /**
     * 删除手牌
     * 
     * @param Card $card 牌
     */
    public function removeCard(Card $card) : void {
        $this->cards = array_diff($this->cards, [$card]);
    }

    /**
     * 导出数据
     */
    public function exportData(){
        $result = [];
        foreach($this->cards as $card){
            $result[] = $card->exportData();
        }
        return $result;
    }
}
