<?php

$loader = require 'vendor/autoload.php';
$loader->setPsr4('app\\', array(__DIR__.'/src'));

require 'includes.php';

(new \app\web\Api)->run();
