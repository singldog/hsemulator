<?php

/**
 * @name 用户登陆
 * @icon account_circle
 * 
 * $param name:username required:true type:string
 * $param name:password required:true type:string
 * 
 * @return onSuccess:16位16进制accessToken
 * 
 * @log date:4/12 text:添加了实现
 * @log date:4/20 text:完善了实现
 */

use \app\db\Player;
 
$username = $this->requiredParam('username');
$password = $this->requiredParam('password');

$players = Player::find([
    'username' => $username
]);

if(count($players) == 0){
    throw new Exception('该用户不存在');
}

if(count($players) > 1){
    throw new Exception('系统内部存在错误：出重名用户');
}

if($players[0]->password != sha1($password)){
    throw new Exception('密码错误');
}

$this->success(['accessToken'=>$player[0]->accessToken]);

