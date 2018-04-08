<?php

/**
 * @name 玩家进入大厅
 * @desc 将玩家的playerToken写入大厅中
 * @param playerToken 玩家令牌
 * @param testToken 玩家令牌
 */

$token = $this->requiredParam('playerToken');

app\util\memory\GameMemoryShare::getInstance()->addPlayerToHall($token);

