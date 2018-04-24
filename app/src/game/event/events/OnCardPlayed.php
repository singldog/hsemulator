<?php

namespace app\game\event\events;

abstract class OnCardPlayed implements \app\game\event\EventAdapter{
    public function adaptEvent($event){
        $event->source->onCardPlayed($event);
    }

    abstract public function onCardPlayed($event);
}
