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
    }

}
