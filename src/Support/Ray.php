<?php

namespace Spatie\GlobalRay\Support;

class Ray
{
    public static function getPharPath()
    {
        $phpVersion = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;

        return __DIR__ . "/../../ray-phars/ray_php_{$phpVersion}.phar";
    }
}
