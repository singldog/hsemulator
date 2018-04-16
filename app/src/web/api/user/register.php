<?php

/**
 * @name 用户注册
 * 
 * $param name:username required:true type:string
 * $param name:password required:true type:string
 * 
 */

use \app\db\Player;

$username = $this->requiredParam('username');
$password = $this->requiredParam('password');

$players = Player::count([
    'username' => $username,
]);

if(count($players)){
    throw new Exception('已经存在该用户');
}

$newPlayer = new Player();
$newPlayer->username = $username;
$newPlayer->password = $password;
$result = $newPlayer->save();

if($result->getInsertedCount()!=1){
    throw new \Exception('注册失败');
}