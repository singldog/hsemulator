<?php

namespace app\game\basis;

/**
 * 类随从
 * 
 * 用于扩展或描述类似小鬼传送门的可在游戏中展现但无部分随从特征的类随从物体
 */
class MinionBase extends GameObject implements IMinionBase{
    use \app\util\traits\AfterBindTrait;

    public $card;

    public function __construct($name, $imgUri, $card){
        parent::__construct($name, $imgUri);
        $this->card = $card;
    }

}
