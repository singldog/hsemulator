<?php

namespace app\web;

/**
 * 接口类
 */
class Api{

    /**
     * 调用接口以运行api程序
     * 举例：访问url:http://域名/user/register，则访问src/api/user/register.php
     * 所有分离的api文件都可以调用定义于Api类中的方法
     */
    public function run() : void{
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

    /**
     * 以错误结束程序
     * 
     * @param string $errorMsg 错误信息
     * @param int $errorNo 错误码
     * @param mixed $data 需要输出的调试数据
     */
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

    /**
     * 以成功结束程序
     * 
     * @param mixed $data 需要输出的数据
     */
    public function success($data = null){
        $result = ['success' => 1];
        if(isset($data)){
            $result['data'] = $data;
        }
        $this->ret($result);
    }

    /**
     * 结束程序并输出数据
     * 
     * @param mixed $data 需要输出的数据
     */
    public function ret($data = []){
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取参数
     * 
     * @param string $name 参数名称
     * @param mixed $defaultValue 若没有传此参数时返回的默认值
     * @param mixed $evadeValue 用于规避参数默认值，例如空字符串，可视为未提供函数。未提供函数的情况下，返回默认值。
     */
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

    /**
     * 获取必须的参数，若获取不到则报错
     * 
     * @param string $name 参数名称
     */
    public function requiredParam($name){
        if(isset($_REQUEST[$name])){
            return $_REQUEST[$name];
        }
        throw new \Exception('参数'.$name.'缺失');
    }
}
