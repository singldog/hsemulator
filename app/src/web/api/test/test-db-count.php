<?php

use \app\db\Player;
 
$username = $this->requiredParam('username');
$password = $this->requiredParam('password');

$players = Player::count([
    'username' => $username,
]);

dd($players);
