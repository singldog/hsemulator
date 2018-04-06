<?php

$apiDir = $_SERVER["DOCUMENT_ROOT"]."/src/web/api/";

$apis = [];

foreach(scandir($apiDir) as $group){
    if($group == "." || $group == "..") continue;
    $apis[$group] = [];
    foreach(scandir($apiDir.$group) as $api){
        if($api == "." || $api == "..") continue;
        $url = $apiDir."/".$group."/".$api;
        $file = file_get_contents($url);
        $attrs = @explode("\r\n * @", explode("\r\n */", explode("/**\r\n * @", $file)[1])[0]);
        $url = $group."/".str_replace(".php", "", $api);
        $obj = [
            "url" => $url
        ];
        foreach($attrs as $attr){
            $aa = explode(" ", $a);
            if(count($aa)==2){
                if(array_key_exists($aa[0], $obj)){
                    if(is_array($obj[$aa[0]])){
                        $obj[$aa[0]] = array_merge([$aa[1]], $obj[$aa[0]]);
                    }else{
                        $obj[$aa[0]] = array_merge([$aa[1]], [$obj[$aa[0]]]);
                    }
                }else{
                    $obj[$aa[0]] = $aa[1];
                }
            }
        }
        $apis[$group][] = $obj;
    }
}

dd($apis);
