<?php

/**
 * @name 用户登陆
 * 
 * $param name:username required:true type:string
 * $param name:password required:true type:string
 * 
 * @return onSuccess:16位16进制accessToken
 * 
 * @log date:4/12 text:添加了实现
 */

use \app\db\Player;
 
$username = $this->requiredParam('username');
$password = $this->requiredParam('password');

$players = Player::find([
    'username' => $username,
    'password' => $password,
]);

