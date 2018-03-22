<?php

namespace app\util\memory;

class MemoryShare{
    use \app\util\traits\StaticInstanceTrait;
    
    public $key;
    public $data;
    private $shm_id;

    public const BLOCKSIZE_1B = 1<<3;
    public const BLOCKSIZE_1K = self::BLOCKSIZE_1B<<10;
    public const BLOCKSIZE_1M = self::BLOCKSIZE_1K<<10;
    public const BLOCKSIZE_ONE_PLAY = self::BLOCKSIZE_1M;

    public function __construct($key, $data = []){
        $this->key = $key;
        $this->data = $data;
    }

    public function read($blockSize, $firstAccess = false){
        if($firstAccess){
            $flags = "c";
            $mode = 0644;
        }else{
            $flags = "w";
            $mode = 0;
            $blockSize = 0;
        }
        $this->shm_id = shmop_open($shm_key, $flags, $mode, $blockSize);
    }

    public function save(){
        $result = shmop_write($this->shm_id, $this->data, 0);
        if($result === false){
            throw new \Exception('');
        }
    }
}
