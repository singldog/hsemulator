<?php

namespace app\game\render\status;

use app\game\render\ChainedRenderer;

abstract class Status extends ChainedRenderer{

    public $status;
    public $statusEvents;

    public function __construct($status, $statusEvents){
        $this->status = $status;
        $this->$statusEvents = $statusEvents;
    }
    
}