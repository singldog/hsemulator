<?php

/**
 * name 玩家退出大厅
 * desc 从内存头信息中移除玩家token
 * param token 玩家令牌
 */

$token = $this->requiredParam('playerToken');

app\util\memory\GameMemoryShare::getInstance()->removePlayerFromHall($token);

