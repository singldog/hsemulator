<?php

namespace app\game\event;

abstract class EventListener{

    protected $acceptedEventType = [];

    public function acceptEvent($event){
        foreach($this->acceptedEventType as $eventType){
            if(is_subclass_of($event, $eventType)) return true;
        }
        return false;
    }

    public abstract function listenEvent($event);
}
