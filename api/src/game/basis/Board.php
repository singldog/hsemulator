<?php

namespace app\game\basis;

use app\game\basis\MinionBase;
use app\util\IDatable;

/**
 * 某一方玩家的场面（随从合集）
 */
class Board implements IDatable{
    
    /**
     * 该玩家的所有随从
     */
    public $minionBases = [];

    public $player;

    /**
     * 添加一个类随从（若已存在则不会添加）
     * 
     * @param MinionBase $mb 需要添加的类随从
     */
    public function addMinionBase(MinionBase $mb) : void {
        if(!in_array($mb, $this->minionBases, true)){
            $this->minionBases[] = $mb;
            $mb->$board = $this;
        }
    }

    /**
     * 删除一个类随从（若不存在则不会删除）
     * 
     * @param MinionBase $mb 需要删除的类随从
     */
    public function removeMinionBase(MinionBase $mb) : void {
        $this->minionBases = array_diff($this->minionBases, [$mb]);
        $mb->$board = null;
    }

    /**
     * 导出数据
     */
    public function exportData(){
        $result = [];
        foreach($this->minionBases as $mb){
            $result[] = $mb->exportData();
        }
        return $result;
    }

}
