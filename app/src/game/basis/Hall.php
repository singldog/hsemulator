<?php

namespace app\game\basis;

use \app\util\memory\GameMemoryShare;

/**
 * 大厅类
 */
class Hall implements IDatable{
    use \app\util\traits\StaticInstanceTrait;

    public function gameMatch(){
        $gms = GameMemoryShare::getInstance();
        $player = $gms->getPlayerTokens();
    }

    
}
