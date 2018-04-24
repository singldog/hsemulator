<?php

/**
 * @name 用户注册
 * 
 * $param name:username required:true type:string
 * $param name:password required:true type:string
 * 
 * @log date:4/20 text:在创建用户时添加了token
 */

use \app\db\Player;

$username = $this->requiredParam('username');
$password = $this->requiredParam('password');

$players = Player::find([
    'username' => $username,
]);

if(count($players)){
    throw new Exception('已经存在该用户');
}

$newPlayer = new Player();
$newPlayer->username = $username;
$newPlayer->password = sha1($password);
$newPlayer->accessToken = md5($username.time());
$result = $newPlayer->save();

if($result->getInsertedCount()!=1){
    throw new \Exception('注册失败');
}