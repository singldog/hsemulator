<?php

namespace app\util\memory;

/**
 * 内存共享
 */
class MemoryShare{
    use \app\util\traits\StaticInstanceTrait;
    
    /**
     * 内存块id，用于操作内存块
     */
    private $shm_id;

    public const BLOCKSIZE_1B = 1;
    public const BLOCKSIZE_1K = self::BLOCKSIZE_1B<<10;
    public const BLOCKSIZE_1M = self::BLOCKSIZE_1K<<10;

    /**
     * 打开某个内存块
     * 
     * @param int $key 内存首地址
     * @param int $blockSize 区块大小
     * @param int $firstAccess 是否是第一次打开
     */
    public function open($key, $blockSize, $firstAccess = false){
        if($firstAccess){
            $this->shm_id = shmop_open($key, "c", 0644, $blockSize);
        }else{
            $this->shm_id = shmop_open($key, "w", 0, 0);
        }
    }

    /**
     * 保存数据至内存
     * 
     * @param mixed $data 需要保存的数据
     * @param int $offset 相对于首地址的内存地址
     */
    public function save($data, $offset = 0, $blockSize = self::BLOCKSIZE_1M){
        $result = shmop_write($this->shm_id, pack('A*', str_pad(serialize($data), $blockSize)), $offset);
        if($result === false){
            throw new \Exception('保存信息至内存时失败', 13);
        }
        return $result;
    }

    /**
     * 读取内存数据
     * 
     * @param int $offset 相对于首地址的内存地址
     * @param int $blockSize 区块大小
     */
    public function read($offset = 0, $blockSize = self::BLOCKSIZE_1M){
        return unserialize(trim(unpack('A*', shmop_read($this->shm_id, $offset, $blockSize))[1]));
    }
}
