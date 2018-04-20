<?php

$arr1 = [
    1 => 'test1',
    2 => 'test2',
    3 => 'test3',
    4 => 'test4',
];

$arr0 = [
    'placeholder' => 'hello'
];

$arr = array_merge($arr0, $arr1);
echo json_encode($arr);
die();
$this->success($arr);
