<?php

d($_SERVER['REQUEST_URI']);

d(explode('?', $_SERVER['REQUEST_URI']));

dd(array_filter(explode('/', explode('?', $_SERVER['REQUEST_URI'])[0])));

