<?php

namespace app\game\basis;

use app\game\basis\IDatable;

/**
 * 类随从
 * 
 * 随从的父类，用于扩展或描述类似小鬼传送门的可在游戏中展现但无部分随从特征的类随从物体
 */
class MinionBase implements IDatable{
    use \app\util\traits\AfterBindTrait;
    
    public $imgUri;
    public $name;
    public $desc;

    public function destroy(){
        $this->board->removeMinionBase($this);
    }

    public function exportData(){
        return [
            'imgUri' => $this->imgUri,
            'name' => $this->name,
            'desc' => $this->desc,
        ];
    }
    
}
