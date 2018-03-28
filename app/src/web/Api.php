<?php

namespace app\web;

class Api{
    public function run(){
        $api_path = api_path();
        if(file_exists($api_path)){
            try{
                require $api_path;
                $this->success();
            }catch(\Exception $e){
                $this->error($e->getmessage(), $e->getcode(), isset($e->data)?:null);
            }
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

    public function getParam($name, $defaultValue = -1, $evadeValue = ''){
        if(isset($_REQUEST[$name])){
            $val = $_REQUEST[$name];
            if($val == $evadeValue)
                return $defaultValue;
            return $val;
        }else{
            return $defaultValue;
        }
    }

    public function requiredParam($name){
        if(isset($_REQUEST[$name])){
            return $_REQUEST[$name];
        }
        throw new \Exception('参数'.$name.'缺失');
    }
}
