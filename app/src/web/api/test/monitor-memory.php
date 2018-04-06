<?php

/**
 * @name 检测内存
 * @desc 查看服务器内存头信息
 */

$gms = app\util\memory\GameMemoryShare::getInstance();

dd($gms->gameHeader);

