<?php

namespace test;

use app\util\memory\MemoryShare;

var_dump(__NAMESPACE__);
var_dump(MemoryShare::class);
var_dump(MemoryShare::BLOCKSIZE_1M, 1<<3<<10<<10);

