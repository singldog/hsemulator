<?php

namespace app\data\cards;

use app\game\basis\MinionCard;
use app\game\basis\IMinionConstructor;

class Elven_Archer extends MinionCard implements IMinionConstructor{
    use \app\util\traits\StaticInstanceTrait, DefaultCardTrait;

    public $mana = 1;
    public $attack = 1;
    public $health = 1;

}
