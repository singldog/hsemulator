<?php

$arr = [];

$null = null;

$arr[$null] = '123';

$emptyString = "";

$arr[$emptyString] = '456';

var_dump($arr);
