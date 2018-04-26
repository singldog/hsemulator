<?php

namespace app\game\event\events;

use app\game\event\Event;

class BeforeAttackEvent extends Event{

    public function __construct($source, $target){
        parent::__construct($source, ['target'=>$target]);
    }

}
