<?php

/**
 * @name 检测内存头信息
 * @desc 查看服务器内存头信息
 * @icon tv
 * 
 */

$gms = \app\game\GameMemoryShare::getInstance();

dd($gms->gameHeader);

