<?php

namespace app\db;

class Player implements \MongoDB\BSON\Persistable{
    use \app\util\db\PersistableTrait;

    public $username;
    public $password;

    public static function findByToken($token){
        $result = self::find(['accessToken'=>$token]);
        return $result[0];
    }

}
