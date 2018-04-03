<?php

namespace app\game\basis;

use app\game\render;

/**
 * 游戏物体
 */
class GameObject{

    public $name;
    public $imgUri;

    public function __construct($name, $imgUri){
        $this->name = $name;
        $this->imgUri = $imgUri;
    }

}
