<?php

$loader = require 'vendor/autoload.php';
$loader->setPsr4('app\\', array(__DIR__));

require 'test\TestBitCalc.php';
