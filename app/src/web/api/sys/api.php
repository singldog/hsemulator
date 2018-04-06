<?php

/**
 * @name 获取所有系统api
 * @desc 分组将所有api信息返回，api信息从文件注释中读取
 */

$apiDir = $_SERVER["DOCUMENT_ROOT"]."/src/web/api/";
$apis = [];

foreach(scandir($apiDir) as $group){
    if($group == "." || $group == "..") continue;
    $apis[$group] = [];
    foreach(scandir($apiDir.$group) as $api){
        if($api == "." || $api == "..") continue;
        $url = $apiDir."/".$group."/".$api;
        $file = file_get_contents($url);
        $attrs = @array_filter(explode(conf('lineBreaker')." * @", explode(conf('lineBreaker')." */", explode("/**".conf('lineBreaker')." * @", $file)[1])[0]));
        $url = $group."/".str_replace(".php", "", $api);
        $obj = [
            "url" => $url
        ];
        $record = [];
        foreach($attrs as $attr){
            $attr = explode(" ", $attr, 2);
            $attrName = $attr[0];
            $attrValue = $attr[1];
            $attrValueArr = explode(" ", $attrValue);
            
            if(count($attrValueArr)>1){
                $attrValue = $attrValueArr;
            }

            if(@$record[$attrName]){
                if($record[$attrName] == 1){
                    $obj[$attrName] = array_merge([$obj[$attrName]], [$attrValue]);
                }else{
                    $obj[$attrName] = array_merge($obj[$attrName], [$attrValue]);
                }
            }else{
                $obj[$attrName] = $attrValue;
            }

            if(!array_key_exists($attrName, $record)){
                $record[$attrName]=0;
            }
            $record[$attrName]++;
        }
        $apis[$group][] = $obj;
    }
}

return $this->success($apis);
