<?php

$mb = new \app\game\basis\MinionBase;

$mb->bindMessage('hahaha it succeeded');
$mb->bindMessage('hahaha it succeeded 2');

var_dump($mb);

var_dump($mb->message);
