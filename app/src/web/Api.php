<?php

namespace app\web;

class Api{
    public function run(){
        $apiPath = apiPath();
        if(file_exists($apiPath)){
            require $apiPath;
        }else{
            $this->error('没有找到指定的api');
        }
    }

    public function error($errorMsg = null, $errorNo = null, $data = null){
        $result = ['success' => 0];
        if(isset($errorMsg)){
            $result['errorMsg'] = $errorMsg;
        }
        if(isset($errorNo)){
            $result['errorNo'] = $errorNo;
        }
        if(isset($data)){
            $result['data'] = $data;
        }
        $this->ret($result);
    }

    public function success($data = null){
        $result = ['success' => 1];
        if(isset($data)){
            $result['data'] = $data;
        }
        $this->ret($result);
    }

    public function ret($data = []){
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
