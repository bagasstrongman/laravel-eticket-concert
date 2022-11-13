<?php

use Carbon\Carbon;

if (!function_exists('dateYmdToDmy')) {
    /**
     * Convert date format from Y-m-d to d-m-Y
     *
     * @param mixed $date
     * @return date
     */
    function dateYmdToDmy($date)
    {
        return Carbon::parse($date)->format('d-m-Y');
    }
}

if (!function_exists('dateDmyToYmd')) {
    /**
     * Convert date format from d-m-Y to Y-m-d
     *
     * @param mixed $date
     * @return date
     */
    function dateDmyToYmd($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}