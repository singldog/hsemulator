<?php

namespace app\game\basis;

use \app\util\memory\GameMemoryShare;

/**
 * 大厅类
 */
class Hall implements IDatable{
    use \app\util\traits\StaticInstanceTrait;

    public function gameMatch(){
        $gms = GameMemoryShare::getInstance();
        $playerTokens = $gms->getPlayerTokens();

        $toBeRemoved = [];

        //目前的实现办法是每有两个用户便组成一对
        for($i=0; $i<count($playerTokens)-1; $i+=2){

            //获取一对token
            $p1t = $playerTokens[$i];
            $p2t = $playerTokens[$i+1];
            $toBeRemoved[] = $p1t;
            $toBeRemoved[] = $p2t;

            //获取数据库信息
            $dbPlayer1 = \app\db\Player::findByToken($p1t);
            $dbPlayer2 = \app\db\Player::findByToken($p2t);

            //使用信息生成对象
            $gamePlayer1 = \app\game\basis\Player::spawnFromInfo($dbPlayer1);
            $gamePlayer2 = \app\game\basis\Player::spawnFromInfo($dbPlayer2);

            //生成游戏并写入内存
            $game = new \app\game\basis\Game($gamePlayer1, $gamePlayer2);
            $gameToken = $gms->createGameBlock($game);
        }

        $gms->removePlayerFromHall($toBeRemoved);

    }

    
}
