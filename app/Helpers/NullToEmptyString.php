<?php

if (!function_exists('nullToEmptyString')) {
    /**
     * Replace null varible to empty string
     * 
     * @param mixed $varible
     * @return string
     */
    function nullToEmptyString($varible)
    {
        return $varible = $varible === null ? "" : $varible;
    }
}