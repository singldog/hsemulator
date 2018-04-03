<?php

namespace app\game\basis;

use app\game\basis\MinionBase;

/**
 * 某一方玩家的场面（随从合集）
 */
class Board implements IDatable{
    use \app\util\traits\AfterBindTrait;
    
    /**
     * 该玩家的所有随从
     */
    public $minionBases = [];

    /**
     * afterbind:
     * public $player;
     */

    /**
     * 添加一个类随从（若已存在则不会添加）
     * 
     * @param MinionBase $mb 需要添加的类随从
     */
    public function addMinionBase(MinionBase $mb) : void {
        if(!in_array($mb, $this->minionBases)){
            $this->minionBases[] = $mb;
        }
    }

    /**
     * 删除一个类随从（若不存在则不会删除）
     * 
     * @param MinionBase $mb 需要删除的类随从
     */
    public function removeMinionBase(MinionBase $mb) : void {
        $this->minionBases = array_diff($this->minionBases, [$mb]);
    }

    /**
     * 导出数据
     */
    public function exportData(){
        $result = [];
        foreach($minionBases as $mb){
            $result[] = $mb->exportData();
        }
        return $result;
    }



}
