<?php

$arr = ['123', '456', '789'];

var_dump($arr);
echo "<br>";

unset($arr[1]);
var_dump($arr);
echo "<br>";

$arr[] = "000";
var_dump($arr);
echo "<br>";
