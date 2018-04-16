<?php

/**
 * @desc 测试function是否支持before和after
 */

class Test{
    
    public function _before_output(){
        echo 'before ';
    }
    
    public function output(){
        echo 'outputed';
    }
    
    public function _after_output(){
        echo ' after';
    }
}

$test = new Test();
$test->output();
die();