<?php

function first_missing_index($arr){
    for($i = 0; $i<count($arr); $i++){
        if(!array_key_exists($i, $arr)){
            return $i;
        }
    }
}

function conf($key, $val=null){
    if($val===null){
        return \app\util\localize\LocalJson::getInstance()->get($key);
    }else{
        return \app\util\localize\LocalJson::getInstance()->set($key, $val);
    }
}
