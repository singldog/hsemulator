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
        foreach($attrs as $attr){
            $aa = explode(" ", $attr, 2);
            if(count($aa)==2){
                $aaContent = explode(" ", $aa[1]);
                if(count($aaContent)==2){
                    $aa[1] = [$aaContent];
                }
                $obj[$aa[0]] = array_merge(@$obj[$aa[0]]??[], [$aa[1]]);
            }
        }
        $apis[$group][] = $obj;
    }
}

return $this->success($apis);
