<?php

/**
 * @name 获取所有系统api
 * @desc 分组将所有api信息返回，api信息从文件注释中读取
 * @icon featured_play_list
 * 
 * $param name:requireRedundant type:int valueAllowed:[0,1] default:0 required:false desc:是否获取非必要信息，传1可获取全部，例如createTime，modifyTime
 * 
 * $log date:4/8 text:修改标记，现在使用$标记拥有多个值的项
 * $log date:4/8 text:修改sys/api返回结构,文档多值项现在可指定二级键名
 * $log date:4/8 text:添加requireRedundant参数
 * $log date:4/8 text:完善了二级值解析，现在支持json格式数据
 */

$apiDir = $_SERVER["DOCUMENT_ROOT"]."/src/web/api/";
$apis = [];

$requireRedundant = $this->getParam('requireRedundant', 0);

foreach(scandir($apiDir) as $group){
    if($group == "." || $group == "..") continue;
    $apis[$group] = [];
    foreach(scandir($apiDir.$group) as $api){
        if($api == "." || $api == "..") continue;
        $fileUrl = $apiDir."/".$group."/".$api;
        $file = file_get_contents($fileUrl);
        $attrs = @array_filter(explode(conf('lineBreaker')." * ", explode(conf('lineBreaker')." */", explode("/**".conf('lineBreaker')." * ", $file)[1])[0]));
        $url = $group."/".str_replace(".php", "", $api);
        $obj = [
            "url" => $url
        ];
        if($requireRedundant){
            $obj['createTime'] = filectime($fileUrl);
            $obj['modifyTime'] = filemtime($fileUrl);
        }
        $record = [];
        foreach($attrs as $attr){
            $attr = explode(" ", $attr, 2);
            $attrKey = $attr[0];
            $attrBecon = substr($attrKey, 0, 1);
            $attrName = substr($attrKey, 1, strlen($attrKey)-1);
            $attrValue = count($attr)>1?$attr[1]:$attr[0];
            $attrValueArrTemp = explode(" ", $attrValue);
            $attrValueArr = [];
            foreach($attrValueArrTemp as $val){
                $innerPair = explode(':', $val);
                if(count($innerPair) == 2){
                    $attrValueArr[$innerPair[0]] = json_decode($innerPair[1])??$innerPair[1];
                }else{
                    $attrValueArr = json_decode($innerPair[0])??$innerPair[0];
                }
            }
            
            if(count((array)$attrValueArr)>0){
                $attrValue = $attrValueArr;
            }

            if(@$record[$attrName]){
                if($record[$attrName] == 1){
                    if($attrBecon=='$'){
                        $obj[$attrName] = array_merge($obj[$attrName], [$attrValue]);
                    }else{
                        $obj[$attrName] = array_merge([$obj[$attrName]], [$attrValue]);
                    }
                }else{
                    $obj[$attrName] = array_merge($obj[$attrName], [$attrValue]);
                }
            }else{
                if($attrBecon=='$'){
                    $obj[$attrName] = [$attrValue];
                }else{
                    $obj[$attrName] = $attrValue;
                }
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
