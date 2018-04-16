<?php

namespace app\db;

class Player implements \MongoDB\BSON\Persistable{
    use \app\util\db\PersistableTrait;

    public $username;
    public $password;

}
