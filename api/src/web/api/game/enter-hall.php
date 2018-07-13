<?php

/**
 * @name 玩家进入大厅
 * @icon arrow_forward
 * @desc 将玩家的playerToken写入大厅中
 * $param name:playerToken desc:玩家令牌 required:true
 */

$token = $this->requiredParam('playerToken');

\app\game\GameMemoryShare::getInstance()->addPlayerToHall($token);

