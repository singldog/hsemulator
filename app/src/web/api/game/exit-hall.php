<?php

$token = $this->requiredParam('playerToken');

app\util\memory\GameMemoryShare::getInstance()->removePlayerFromHall($token);

