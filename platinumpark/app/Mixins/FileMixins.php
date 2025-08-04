<?php

namespace App\Mixins;

use Closure;

class FileMixins
{
    public function checkExists(): Closure
    {
        return function ($object, $key, $default) {
            if (!empty($object->{$key}) && isset($object->{$key})) {
                return @file_get_contents($object->{$key}) ? $object->{$key} : $default;
            }

            return $default;
        };
    }
}
