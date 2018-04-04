<?php

namespace app\game\basis;

/**
 * 类随从
 * 
 * 随从的父类，也用于扩展或描述类似小鬼传送门的可在游戏中展现但无部分随从特征的类随从物体
 */
class MinionBase extends Character{
    use \app\util\traits\AfterBindTrait;
    
    /**
     * 图片地址
     */
    public $imgUri;
    /**
     * 名称
     */
    public $name;
    /**
     * 卡牌
     */
    public $card;
    /**
     * afterbind:
     * public $board;
     */

    public function __construct($name, $imgUri, $card){
        $this->name = $name;
        $this->imgUri = $imgUri;
        $this->card = $card;
    }

    /**
     * 从board消灭该随从
     */
    public function destroy(){
        $this->board->removeMinionBase($this);
    }
    
}
