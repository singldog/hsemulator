<?php

namespace app\game\basis;

class Board implements IDatable{
    use \app\util\traits\AfterBindTrait;
    
    public $minionBases = [];

    public function addMinionBase($mb){
        $minionBases[] = $mb;
    }

    public function removeMinionBase($mb){
        $this->minionBases = array_diff($this->minionBases, [$mb]);
    }

    public function exportData(){
        $result = [];
        foreach($minionBases as $mb){
            $result[] = $mb->exportData();
        }
        return $result;
    }



}
