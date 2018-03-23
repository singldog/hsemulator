<?php

$loader = require 'vendor/autoload.php';
$loader->setPsr4('app\\', array(__DIR__.'/src'));

require 'includes.php';

//require 'test\TestMemoryShare.php';
require 'src/test/TestMemoryShare.php';

//phpinfo();
