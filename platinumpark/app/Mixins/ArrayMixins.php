<?php

namespace App\Mixins;

use Closure;

class ArrayMixins
{
    public function convertToObject(): Closure
    {
        return function (array $array) {
            return json_decode(json_encode($array));
        };
    }
}
