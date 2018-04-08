<?php

/**
 * @name 关闭游戏匹配进程
 * @desc 关闭游戏中玩家点击开始后的匹配进程。终止循环调用。
 * 
 * $seealso api:sys/start-game-matching why:开启进程的操作由该接口发起。
 */

conf('gameMatchThread', false);
