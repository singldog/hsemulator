<?php

/**
 * @name 开启游戏匹配进程
 * @desc 开启游戏中玩家点击开始后的匹配进程。该进程循环调用自己。
 * 
 * $param name:autoCall required:false type:int desc:是否自动调用。请勿手动传入此参数！！！
 * $seealso api:sys/end-game-matching why:若要关闭此进程，请调用该接口
 * 
 * $log date:4/26 text:sleep函数参数单位为秒，从2000修改为2；file_get_contents设置超时时间为1秒
 */

$started = data('gameMatchThread');
$autoCall = $this->getParam('autoCall', 0, '');

if($started===false){
    if($autoCall){
        return;
    }else{
        data('gameMatchThread', true);
    }
}else{
    if(!$autoCall){
        throw new Exception('匹配进程已经开启，请勿重复此操作');
    }
}

\app\game\basis\Hall::getInstance()->gameMatch();

sleep(2);

$opts = [
    'http'=>[
        'method'=>"GET",
        'timeout'=>1,
    ]
];
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?autoCall=1';
@file_get_contents($url, false, stream_context_create($opts));
