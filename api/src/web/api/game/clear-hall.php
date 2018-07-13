<?php

/**
 * @name 清空游戏大厅
 * @icon refresh
 * @desc 使用GameMemoryShare清空游戏头信息
 */

\app\game\GameMemoryShare::getInstance()->deleteAll();