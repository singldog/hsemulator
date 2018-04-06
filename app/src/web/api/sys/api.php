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
        $attr = @explode("\r\n * @", explode("\r\n */", explode("/**\r\n * @", $file)[1])[0]);
        $url = $group."/".str_replace(".php", "", $api);
        $obj = [
            "url" => $url
        ];
        foreach($attr as $a){
            $aa = explode(" ", $a);
            if(count($aa)==2){
                $obj[$aa[0]] = $aa[1];
            }
        }
        $apis[$group][] = $obj;
    }
}

dd($apis);
