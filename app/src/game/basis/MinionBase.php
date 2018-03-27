<?php

namespace app\game\basis;

use app\game\basis\IDatable;

class MinionBase implements IDatable{
    use \app\util\traits\AfterBindTrait;
    
    public $imgUri;
    public $name;
    public $desc;

    public function destroy(){
        $this->board->removeMinionBase($this);
    }

    public function exportData(){
        return [
            'imgUri' => $this->imgUri,
            'name' => $this->name,
            'desc' => $this->desc,
        ];
    }
    
}
