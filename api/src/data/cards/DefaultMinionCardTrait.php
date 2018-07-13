<?php

namespace app\data\cards;

trait DefaultCardTrait{

    public function __construct(){
        parent::__construct(
            $this->name??card_file_to_name(self::class), 
            $this->imgUri??card_file_to_img_uri(self::class),
            $this->desc,
            v($this->mana),
            v($this->attack),
            v($this->health),
            $this
        );
    }

    public function constructMinion($card){
        $minion = new Minion($card->name, $card->imgUri, v($card->attack), v($card->health), v($card->mana));
        if($this->processMinion){
            $this->processMinion($minion);
        }
        $this->initEventListeners();
    }

    public function initEventListeners(){
        if(isset($this->eventListeners)){
            foreach($this->eventListeners as $listener){
                game()->registerEventListener($listener);
            }
        }
    }

    public function addEventListener($listener){
        if(isset($this->eventListeners)){
            if(!is_array($this->eventListeners)){
                $this->eventListeners = [];
            }
        }
        $this->eventListeners[] = $listener;
        game()->registerEventListener($listener);
    }
    

}
