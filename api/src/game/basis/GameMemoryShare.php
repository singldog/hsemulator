<?php

namespace app\game;

use app\util\memory\MemoryShare;

class GameMemoryShare{
    use \app\util\traits\StaticInstanceTrait;

    public $memoryShare;
    public $gameHeader;

    public const BLOCKSIZE_ONE_PLAY = MemoryShare::BLOCKSIZE_1M;
    public const BLOCKSIZE_HEADER_INFO = MemoryShare::BLOCKSIZE_1M;
    public const BLOCKSIZE_WHOLE_APP = self::BLOCKSIZE_HEADER_INFO + self::BLOCKSIZE_ONE_PLAY * 50;

    public function __construct(){
        $this->memoryShare = MemoryShare::getInstance();
        $isFirstTime = !data('memoryBlockOpened');
        if($isFirstTime){
            data('memoryBlockOpened', true);
        }
        $this->memoryShare->open(ftok(__FILE__, 'h'), self::BLOCKSIZE_WHOLE_APP, $isFirstTime);
        $this->gameHeader = $this->memoryShare->read(0, self::BLOCKSIZE_HEADER_INFO);
    }

    public function addPlayerToHall($playerToken){
        if(!is_array($this->gameHeader['players'])){
            $this->gameHeader['players'] = [];
        }
        if(!in_array($playerToken, $this->gameHeader['players'])){
            $this->gameHeader['players'][] = $playerToken;
        }
        $this->saveGameHeaderInfo();
    }

    public function removePlayerFromHall($token){
        if(!array_key_exists('players', $this->gameHeader) || !is_array($this->gameHeader['players'])){
            return;
        }
        if(is_array($token)){
            $this->gameHeader['players'] = array_diff($this->gameHeader['players'], $token);
        }else{
            $this->gameHeader['players'] = array_diff($this->gameHeader['players'], [$token]);
        }
        $this->saveGameHeaderInfo();
    }

    public function getPlayerTokens(){
        return $this->gameHeader['players'];
    }

    public function getGameIndex($gameToken){
        return array_search($gameToken, $this->gameHeader);
    }

    public function saveGameHeaderInfo(){
        $this->memoryShare->save($this->gameHeader, 0, self::BLOCKSIZE_HEADER_INFO);
    }

    public function createGameBlock($gameData, $p1token, $p2token){
        if(!isset($this->gameHeader['games'])){
            $this->gameHeader['games'] = [];
        }
        $index = first_missing_index($this->gameHeader['games']);
        $gameToken = md5($id);
        $this->gameHeader['games'][$index] = ['gameToken' => $gameToken, 'playerTokens' => [$p1token, $p2token]];
        $this->saveGameHeaderInfo();
        $this->memoryShare->save($gameData, $this->gameOffset($index), self::BLOCKSIZE_ONE_PLAY);
        return $gameToken;
    }

    public function readGameData($gameToken){
        if(!isset($this->gameHeader['games'])){
            throw new \Exception('无法获取大厅头信息');
        }
        foreach($this->gameHeader['games'] as $key => $gameInfo){
            if($gameInfo['gameToken'] == $gameToken){
                $index = $key;
            }
        }
        if($index)
            return $this->memoryShare->read($this->gameOffset($index), self::BLOCKSIZE_ONE_PLAY);
    }

    public function saveGameData($gameToken, $gameData){
        $index = array_search($gameToken, $this->gameHeader['games']);
        $this->memoryShare->save($gameData, $this->gameOffset($index), self::BLOCKSIZE_ONE_PLAY);
    }

    public function gameOffset($index){
        return self::BLOCKSIZE_HEADER_INFO + $index * self::BLOCKSIZE_ONE_PLAY;
    }

    public function deleteAll(){
        $this->gameHeader['players'] = [];
        $this->saveGameHeaderInfo();
    }
}
