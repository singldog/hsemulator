<?php

namespace app\game\basis;

use app\game\basis\IDatable;

class MinionBase implements IDatable{
    public $imgUri;
    public $name;
    public $desc;
    public $board;

    public function destroy(){

    }
    
}
