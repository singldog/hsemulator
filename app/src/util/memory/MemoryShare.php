<?php

namespace app\util\memory;

class MemoryShare{
    use \app\util\traits\StaticInstanceTrait;
    
    private $shm_id;

    public const BLOCKSIZE_1B = 1<<3;
    public const BLOCKSIZE_1K = self::BLOCKSIZE_1B<<10;
    public const BLOCKSIZE_1M = self::BLOCKSIZE_1K<<10;
    public const BLOCKSIZE_ONE_PLAY = self::BLOCKSIZE_1M;
    public const BLOCKSIZE_HEADER_INFO = self::BLOCKSIZE_1M;
    public const BLOCKSIZE_WHOLE_APP = self::BLOCKSIZE_HEADER_INFO + self::BLOCKSIZE_ONE_PLAY * 50;

    public function open($key, $firstAccess = false, $blockSize = self::BLOCKSIZE_WHOLE_APP){
        if($firstAccess){
            $this->shm_id = shmop_open($key, "c", 0644, $blockSize);
        }else{
            $this->shm_id = shmop_open($key, "w", 0, 0);
        }
    }

    public function save($data, $offset = 0){
        $result = shmop_write($this->shm_id, pack('A*', serialize($data)), $offset);
        if($result === false){
            throw new \Exception('保存信息至内存时失败', 13);
        }
        return $result;
    }

    public function read($offset = 0, $blockSize = self::BLOCKSIZE_1M){
        return unserialize(unpack('A*', shmop_read($this->shm_id, $offset, $blockSize))[1]);
    }
}
