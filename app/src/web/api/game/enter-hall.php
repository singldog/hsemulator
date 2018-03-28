<?php

$token = $this->requiredParam('playerToken');

app\util\memory\GameMemoryShare::getInstance()->addPlayerToHall($token);

