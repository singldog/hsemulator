<?php

namespace app\game\basis;

/**
 * 状态数值
 */
class StatusValue implements IDatable{

    public $val;
    public $standardVal;
    public $status;

    public function __construct($val, $standardVal, $status = self::STATUS_NORMAL){
        $this->val = $val;
        $this->standardVal = $standardVal;
        $this->status = $status;
    }

    public const STATUS_NORMAL = 0;
    public const STATUS_RED = -1;
    public const STATUS_GREEN = 1;

    public function exportData(){
        return [
            'val' => $this->val,
            'standardVal' => $this->standardVal,
            'status' => $this->status,
        ];
    }
}