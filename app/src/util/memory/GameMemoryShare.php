<?php

namespace app\util\memory;

class GameMemoryShare{
    use \app\util\traits\StaticInstanceTrait;

    public $memoryShare;
    public $gameHeaderInfo;

    public function __construct(){
        $this->memoryShare = MemoryShare::getInstance();
        $firstTime = !conf('memoryBlockOpened');
        if($firstTime){
            conf('memoryBlockOpened', true);
        }
        $this->memoryShare->open(ftok(__FILE__, 'h'), $firstTime);
        $this->gameHeaderInfo = $this->memoryShare->read(0, MemoryShare::BLOCKSIZE_HEADER_INFO);
    }

    public function getGameIndex($gameToken){
        return array_search($gameToken, $this->gameHeaderInfo);
    }

    public function saveGameHeaderInfo(){
        $this->memoryShare->save($this->gameHeaderInfo, 0);
    }

    public function createGameBlock($gameToken, $gameData){
        $id = firstMissingIndex();
        $this->$gameHeaderInfo[] = $gameToken;
        $this->memoryShare->save();

        $index = $this->getGameIndex($gameToken);
        
    }

    public function readGameData($gameToken){
        
    }

    public function saveGameData($gameToken, $gameData){
        
    }
}
