<?php

namespace app\util\localize;

/**
 * 本地化存储数据
 */
interface ILocalize{

    /**
     * @param string $key 键
     * @param mixed $val 值
     */
    function set($key, $val);

    /**
     * @param string $key 键
     */
    function get($key);

}
