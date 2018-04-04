<?php

function card_file_to_class($fileName){
    $arr = explode('\\', $fileName);
    return end($arr);
}

function card_class_to_name($className){
    return implode(' ', explode('_', $className));
}

function card_class_to_img_uri($className){
    return conf('assetHost').'images/'.card_class_to_name($className).'jpg';
}

function card_file_to_name($fileName){
    return card_class_to_name(card_file_to_class($fileName));
}

function card_file_to_img_uri($fileName){
    return card_class_to_img_uri(card_file_to_class($fileName));
}

function val_to_status_val($val, $status=0){
    return new \app\game\basis\StatusValue($val, $val, $status);
}

function v($val){
    return val_to_status_val($val);
}