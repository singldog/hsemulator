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
        $eventAdapters = game()->getAllEventAdapters();
        foreach($eventAdapters as $adapter){
            if($adapter->acceptEvent($event)){
                $adapter->adaptEvent($event);
            }
        }
    }

}