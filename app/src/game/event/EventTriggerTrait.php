<?php

namespace app\game\event;

trait EventTriggerTrait{
    private $eventListener = [];

    public function callTriggeringEvent(string $name, ...$args){
        $beforeName = 'before'.ucfirst($name);
        $afterName = 'after'.ucfirst($name);
        if(method_exists($this, $name)){
            $this->triggerEvents($beforeName, $arges);
            call_user_func_array('self::'.$name, $args);
            $this->triggerEvents($beforeName, $args);
        }else{
            throw new Exception('系统找不到指定的方法');
        }
    }

    public function triggerEvents($eventName, $args){
        if(array_key_exists($eventName, $this->eventListeners)){
            $listeners = $this->eventListeners[$eventName];
            if(is_array($listeners))
            foreach($listeners as $listener){
                $listener->listenEvent(new Event($this, $args));
            }
        }
    }
}