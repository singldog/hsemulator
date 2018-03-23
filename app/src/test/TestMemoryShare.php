<?php

use app\util\memory\MemoryShare;

$ms = MemoryShare::getInstance();

$ms->open(ftok(__FILE__, 'h'), true);
$ms->data = ['hahahahaa'=>'here it is'];

var_dump($ms->save());
var_dump($ms->read());

