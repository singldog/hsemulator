<?php

/**
 * @name 匹配进程状态
 * @desc 查看游戏匹配进程状态，以决定是否开启或关闭
 * @icon info
 * 
 * $seealso api:sys/start-game-matching why:开启进程
 * $seealso api:sys/end-game-matching why:关闭进程
 */

$started = data('gameMatchThread');

$this->ret([
    'status' => $started
]);
