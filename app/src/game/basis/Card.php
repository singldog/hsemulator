<?php

namespace app\game\basis;

use app\game\render;

/**
 * 卡牌类
 */
class Card extends GameObject{
    use \app\util\traits\AfterBindTrait;

    public $desc;

    public $hand;

    public function __construct($name, $imgUri, $desc){
        parent::__construct($name, $imgUri);
        $this->desc = $desc;
    }

    public function play(){
        $this->hand->removeCard($this);
    }

    public function exportData(){
        return array_merge(
            parent::exportData(),
            [ 'desc' => $this->desc ]
        );
    }

}
