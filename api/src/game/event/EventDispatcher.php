<?php

namespace app\game\event;

class EventDispatcher{
    use \app\util\traits\StaticInstanceTrait;

    public function dispatchEvents($events){
        foreach($events as $event){
            $this->dispatchEvent($event);
        }
    }

    public function dispatchEvent($event){
        $eventListeners = game()->getAllEventListeners();
        foreach($eventListeners as $listener){
            if($listener->acceptEvent($event)){
                $listener->listenEvent($event);
            }
        }
    }

}