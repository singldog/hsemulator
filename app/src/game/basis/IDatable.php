<?php

namespace app\game\basis;

/**
 * 导出数据用于前端解析
 */
interface IDatable{
    
    /** 导出数据 */
    public function exportData();

}
