<?php

/**
 * @name 玩家退出大厅
 * @icon arrow_backward
 * @desc 从内存头信息中移除玩家token
 * $param name:playerToken desc:玩家令牌 required:true
 * @deprecated
 */

$token = $this->requiredParam('playerToken');

app\util\memory\GameMemoryShare::getInstance()->removePlayerFromHall($token);

