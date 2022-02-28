<?php

namespace Spatie\GlobalRay\Support;

class Dump
{
    public static function getPharPath()
    {
        $phpVersion = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;

        return __DIR__ . "/../../dump-phars/dump_{$phpVersion}.phar";
    }
}
