<?php

namespace app\game\basis;

use app\game\event\EventDispatcher;

abstract class Action{
    
    protected $accpetedSubjectType = [];

    public $subject;
    public $actionLauncher;

    public function __construct($subject, $actionLauncher = null){
        $this->subject = $subject;
        if($actionLauncher == null){
            $this->actionLauncher = $subject;
        }else{
            $this->actionLauncher = $actionLauncher;
        }
        $this->validateBeforeAct();
    }

    public function validateBeforeAct(){
        foreach($this->accpetedSubjectType as $testType){
            if(is_subclass_of($this->subject, $testType)) return true;
        }
        throw new \Exception('采取了未允许的动作');
    }

    public function applyActionTriggeringEvents(){
        $this->validateBeforeAct($this->subject);
        $eb = $this->triggerEventBefore();
        $this->act($this->subject);
        $ea = $this->triggerEventAfter();
    }

    public function triggerEventBefore(){
        $eb = $this->getEvent('Before');
        game()->eventDispatcher->dispatchEvent($eb);
    }

    public function triggerEventAfter(){
        $ea = $this->getEvent('After');
        game()->eventDispatcher->dispatchEvent($ea);
    }

    protected function getEvent($prefix){
        $thisName = (new ReflectionClass(__CLASS__))->getShortName();
        $eventClass = new ReflectionClass('/app/game/event/events/'.$prefix.ucfirst($thisName).'Event');
        return $eventClass->newInstanceArgs(array_merge([$this->subject], $this->eventParams()));
    }

    public abstract function eventParams();

    public abstract function act();

}
