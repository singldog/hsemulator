<?php

use app\util\memory\MemoryShare;

$ms = MemoryShare::getInstance();

$ms->open(ftok(__FILE__, 'h'), true);

var_dump($ms->save(new \Exception('hahahahahaah this is fucking awesome')));
$e = $ms->read();
var_dump($e->getmessage());

