<?php

/**
 * 找到数组中第一个缺失的数字索引
 * 
 * @param array $arr 需要寻找的数组
 */
function first_missing_index($arr) : int{
    for($i = 0; $i<=count($arr); $i++){
        if(!array_key_exists($i, $arr)){
            return $i;
        }
    }
}

function array_rand_elem($array, $num=1){
    $randKey = array_rand($array, $num);
    if($num==1){
        $randKey = [$randKey];
    }
    $result = [];
    foreach($randKey as $key){
        $result[$key] = $array[$key];
    }
    if(count($result==1)){
        return $result[$key];
    }else{
        return $result;
    }
}

/**
 * 读取或写入json文件中的值
 * 
 * @param string $key 键
 * @param string $val 值，若传入则代表写入数据，不可为null
 * 
 * @see \app\util\localize\LocalJson::get()
 * @see \app\util\localize\LocalJson::set()
 */
function data($key, $val=null){
    if(!isset($val)){
        return \app\util\localize\LocalJson::getInstance()->get($key);
    }else{
        return \app\util\localize\LocalJson::getInstance()->set($key, $val);
    }
}


/**
 * 读取配置文件的值
 * 
 * @param string $key 键
 * @param array $levels 前面的层级键
 */
function conf($key, ...$levels){
    $newLevels = array_merge($levels, [$key]);
    $i = 0;
    $result = CONFIG;
    while($i<count($newLevels) && array_key_exists($newLevels[$i], $result)){
        $result = $result[$newLevels[$i]];
        $i++;
    };
    return $result;
}

/**
 * 用嵌套表格的形式打印数据
 * 
 * @param mixed $data 需要打印的数据
 */
function output_as_table($data) : void{
    if(!is_array($data)&&!is_object($data)){
        $data = [$data];
    }
    
    echo '<pre>';
    //if(is_array($data)){
        if(count($data)){
            echo '<table style="font-size:18px;" border="1" cellspacing="0" cellpadding="4">';
            foreach($data as $k=>$v){
                echo '<tr><td> '.$k.' </td><td>';
                if(is_array($v)||is_object($v)){
                    output_as_table($v);
                }else{
                    echo $v;
                }
                echo '</td></tr>';
            }
            echo '</table>';
        }else{
            var_dump($data);
        }
    /* }else{
        echo get_class($data);
        if(is_object($data) && method_exists($data, 'exportData')){
            output_as_table($data->exportData());
        }
    } */
    echo '</pre>';
}

/**
 * 用嵌套表格的形式打印数据 简化名称
 * 
 * @see output_as_table() 原始方法
 */
function d(...$data) : void{
    if(count($data)==1){
        output_as_table($data[0]);
    }else{
        output_as_table($data);
    }
}

/**
 * 用嵌套表格的形式打印数据 并退出程序
 * 
 * @see d() 原始方法
 * @see die() 退出程序
 */
function dd(...$data) : void{
    if(count($data)==1){
        output_as_table($data[0]);
    }else{
        output_as_table($data);
    }
    die();
}

/**
 * 当前请求的api地址
 */
function api_path() : string{
    $uri = array_filter(explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]));
    
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
        conf('dirSeperator'),
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

function mongo(){
    return \app\util\db\MongoBowl::getInstance()->mongo;
}

function env(){
    $env = getenv('HSE_ENV');
    if(!$env){
        $env = 'local';
    }
    return $env;
}

