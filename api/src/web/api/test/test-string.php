<?php
echo memory_get_usage();
echo '<br>';

$str = $this->requiredParam('str');

echo memory_get_usage();
$str.= $str;
$str2 = pack('A*', str_pad($str, 10));
echo '<br>';
echo memory_get_usage();

$i = 65;
$c = chr(65);
echo '<br>';

echo memory_get_usage();

echo '<br>';
var_dump($str);
echo '<br>';
var_dump($str2);
echo '<br>';
var_dump($i, $c);
exit;