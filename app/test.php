<?php

//已废弃，现在若需要测试直接调用api测试即可
//若需要测试特定代码或操作，可新建api以供测试

$loader = require 'vendor/autoload.php';
$loader->setPsr4('app\\', array(__DIR__.'/src'));

require 'includes.php';

echo '<pre>';

require 'src/test/TestBindTrait.php';
//require 'test\TestMemoryShare.php';
//require 'src/test/TestMemoryShare.php';

//phpinfo();
