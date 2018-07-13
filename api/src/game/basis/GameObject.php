<?php

namespace app\game\basis;

use app\game\render;

/**
 * 游戏物体
 */
class GameObject implements IDatable{

    public $name;
    public $imgUri;

    public function __construct($name, $imgUri){
        $this->name = $name;
        $this->imgUri = $imgUri;
    }

    /**
     * 导出数据
     */
    public function exportData(){
        return [
            'name' => $this->name,
            'imgUri' => $this->imgUri,
        ];
    }

}
