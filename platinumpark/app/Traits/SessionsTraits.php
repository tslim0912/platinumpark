<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

/**
 * Description of SessionsTraits
 *
 * @author Tommy
 */
trait SessionsTraits {

    /**
     * set session flash message
     *
     * @param string $key key to store message
     * @param string $val value want to store
     * @param boolean $useConfig default: true, will get message from config
     */
    public function flash($key, $val, $useConfig = FALSE) {
        $msg = ($useConfig) ? config($val) : $val;
        Session::flash($key, $msg);
    }

    public function put($key, $val, $useConfig = FALSE) {
        $msg = ($useConfig) ? config($val) : $val;
        Session::put($key, $msg);
    }

}
