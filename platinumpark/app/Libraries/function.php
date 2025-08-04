<?php

use Carbon\Carbon;

if (!function_exists("_colorCode")) {

    function _colorCode($code) {
        return (preg_match('/#([a-f0-9]{3}){1,2}\b/i', $code));
    }

}

if (!function_exists("_checkIsColor")) {

    function _checkIsColor($name) {
        return (preg_match('/(color)|(Colour)/i', $name));
    }

}

if (!function_exists("_eq")) {

    /**
     * To compare 2 value is same or not
     * <p>
     * </p>
     * @param mixed $val
     * @param mixed $value
     * @param boolean $exactly : optional
     * @return boolean
     */
    function _eq($val, $value, $exactly = false) {
        return ($exactly) ? ($val === $value) : ($val == $value);
    }

}

if (!function_exists("_skuStatus")) {

    function _skuStatus($status = 0) {
        $statusList = config("status.SKU.fixed");
        $result = $statusList[0];

        if (isset($statusList[$status])) {
            $result = $statusList[$status];
        }

        return ucwords($result);
    }

}

if (!function_exists("_status")) {

    function _status($status = 0) {
        $statusList = config("status.default.ucwords");

        return (isset($statusList[$status])) ? $statusList[$status] : "inactive";
    }

}

if (!function_exists("_standardNumberFormat")) {

    function _standardNumberFormat($number) {
        return number_format($number, 2, ".", "");
    }

}

if (!function_exists('_now')) {

    function _now($format = "Y-m-d H:i:s") {
        return Carbon::now(config("app.timezone"))->format('Y-m-d H:i:s');
    }

}
