<?php

namespace app\game\event;

abstract class EventAdapter{

    protected $acceptedEventType = [];

    public function acceptEvent($event){
        foreach($this->acceptedEventType as $eventType){
            if(is_subclass_of($event, $eventType)) return true;
        }
        return false;
    }

    public abstract function adaptEvent($event);
}
