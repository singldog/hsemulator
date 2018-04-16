<?php

namespace app\game\event\events;

abstract class OnCardPlayed implements \app\game\event\EventAdapter{
    public function adaptEvent($event){
        $this->onCardPlayed($event);
    }

    abstract public function onCardPlayed($event);
}
