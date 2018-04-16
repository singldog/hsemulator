<?php

namespace app\util\db;

trait PersistableTrait{

    public $unserialized = false;
    public $naturallyCreated = true;
    public $excludeAttr = ['excludeAttr', 'unserialized', 'naturallyCreated'];

    public function bsonSerialize(){
        if(method_exists($this, 'exportData')){
            $data = $this->exportData();
        }else{
            $data = [];
        }
        return array_merge(['__pclass'=>self::class], $data);
    }

    public function exportData(){
        $vars = get_class_vars(self::class);
        $data = [];
        foreach($vars as $k=>$v){
            if(!in_array($k, $this->excludeAttr)){
                $data[$k] = $this->$k;
            }
        }
        return $data;
    }

    public function bsonUnserialize(array $data){
        foreach ( $data as $k => $v ){
            $this->$k = $v;
        }
        $this->naturallyCreated  = false;
        $this->unserialized  = true;
    }

    public static function find($conditions = []){
        $cursor = mongo()->executeQuery(conf('dbname', 'db').'.'.self::collectionName(), new \MongoDB\Driver\Query($conditions));
        return $cursor->toArray();
    }

    public static function count($conditions = []){
        $cursor = mongo()->executeReadCommand(conf('dbname', 'db'), new \MongoDB\Driver\Command(['count'=>self::collectionName(), 'query'=>$conditions]));
    }

    public static function collectionName(){
        if(array_key_exists('collectionName', get_class_vars(self::class))){
            $collectionName = self::$collectionName;
        }else{
            $collectionName = lcfirst(file_to_class(self::class)).'s';
        }
        return $collectionName;
    }

    public function save(){
        $write = new \MongoDB\Driver\BulkWrite();
        $write->insert($this);
        return mongo()->executeBulkWrite(conf('dbname', 'db').'.'.self::collectionName(), $write);
    }

}
