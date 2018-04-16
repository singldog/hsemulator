<?php

/**
 * @desc 测试function是否支持before和after
 */

class Test{
    
    public function test2(){
        echo 'test';
        echo '<br>';
    }

    public function output(){
        echo method_exists($this, 'output');
        echo '<br>';
        echo call_user_func('test2');
    }

    public function __call($name, $args){
        echo '__called:'.$name;
    }
}

$test = new Test;
$test->output();
die();