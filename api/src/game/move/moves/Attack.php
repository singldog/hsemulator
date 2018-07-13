<?php

namespace app\move\moves;

use app\game\move\Move;
use app\game\action\actions\AttackAction;

class Attack extends Move{

    public function move(){
        extract($this->datapack);
        $attacker = id_to_object($attackerId);
        $target = id_to_object($targetId);
        $action = new AttackAction($attacker, $target);
    }

}