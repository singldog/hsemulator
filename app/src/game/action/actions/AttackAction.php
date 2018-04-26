<?php

namespace app\game\basis;

class AttackAction extends \app\game\action\Action{
    
    protected $accpetedSubjectType = [
        \app\basis\Character::class
    ];

    public $target;

    public function __construct($subject, $target, $actionLauncher = null){
        parent::__construct($subject, $actionLauncher);
        $this->target = $target;
    }

    public function act(){
        $subject->drawACard($this->cardDrawn);
    }

    public function eventParams(){
        return [$this->target];
    }

}
