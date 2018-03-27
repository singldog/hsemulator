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

function outputAsTable($data){
    if(!is_array($data)&&!is_object($data)){
        $data = [$data];
    }
    
    echo '<pre><table style="font-size:18px; width:100%;" border="1" cellspacing="0" cellpadding="4">';
    foreach($data as $k=>$v){
        echo '<tr><td>'.$k.'</td><td>';
        if(is_array($v)||is_object($v)){
            outputAsTable($v);
        }else{
            echo $v;
        }
        echo '</td></tr>';
    }
    echo '</table></pre>';
}

function d($data){
    outputAsTable($data);
}

function dd($data){
    outputAsTable($data);
    die();
}

function apiPath(...$path){
    $uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));
    
    if(count($uri)==0){
        $uri[] = 'index';
    }
    if(count($uri)==1){
        $uri[] = 'index';
    }

    $uriNew = [];
    foreach($uri as $u){
        $uriNew[] = str_replace('.php', '', $u);
    }
    $uri = $uriNew;
    
    return implode(
        config['DIR_SEPERATOR'],
        array_merge(
            [
                $_SERVER['DOCUMENT_ROOT'],
                'src',
                'web',
                'api'
            ],
            $uri
        )
    ).'.php';
}