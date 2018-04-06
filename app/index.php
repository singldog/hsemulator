<?php

//引入自动加载机制
$loader = require 'vendor/autoload.php';
$loader->setPsr4('app\\', array(__DIR__.'/src'));

//引入需要加载的文件
require 'includes.php';

//允许跨域
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET,POST");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

//运行api
(new \app\web\Api)->run();
