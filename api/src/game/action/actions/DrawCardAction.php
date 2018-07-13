<?php

namespace app\game\basis;

class DrawCardAction extends \app\game\action\Action{
    
    protected $accpetedSubjectType = [
        \app\basis\Player::class
    ];

    public $cardDrawn;

    public function __construct($subject, $cardDrawn, $actionLauncher = null){
        parent::__construct($subject, $actionLauncher);
        $this->cardDrawn = $cardDrawn;
    }

    public function act(){
        $subject->drawACard($this->cardDrawn);
    }

    public function eventParams(){
        return [$this->cardDrawn];
    }

}
