<?php

namespace Spatie\GlobalRay\Support;

class Platform
{
    public static function isWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    public static function isWindowsNonAdminUser(): bool
    {
        if (! static::isWindows()) {
            return false;
        }

        exec('fltmc.exe filters', $output, $exitCode);

        return $exitCode !== 0;
    }
}
