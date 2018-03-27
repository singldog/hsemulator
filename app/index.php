<?php

$loader = require 'vendor/autoload.php';
$loader->setPsr4('app\\', array(__DIR__.'/src'));

require 'includes.php';
$config = require 'src/config/config.php';
define('config', $config);

(new \app\web\Api)->run();
