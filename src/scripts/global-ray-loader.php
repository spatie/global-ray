<?php

namespace Spatie\GlobalRay;

include_once __DIR__ . "/../Support/Ray.php";
include_once __DIR__ . "/../Support/Dump.php";

use Spatie\GlobalRay\Support\Dump;
use Spatie\GlobalRay\Support\Ray;

class PharLoader
{
    public static function load(string $pharPath, array $unlessDetectedPackages)
    {
        $composerJson = self::getComposerPath();

        if (file_exists($composerJson)) {
            $composer = json_decode(file_get_contents($composerJson), true);

            foreach (['require', 'require-dev'] as $require) {
                foreach ($composer[$require] ?? [] as $package => $version) {
                    if (in_array($package, $unlessDetectedPackages)) {
                        return;
                    }
                }
            }
        }

        if (file_exists($pharPath)) {
            include_once $pharPath;
        }
    }

    public static function isRunningInLaravelAwareApp()
    {
        return defined('STDIN')
            && strpos($_SERVER['argv'][0] ?? '', 'tinker.phar') !== false;
    }

    public static function getComposerPath()
    {
        $composerJson = getcwd() . '/composer.json';

        // Check if it is Laravel Valet.
        if(strpos($composerJson, 'valet') != false) {
            $valetConfig = json_decode(file_get_contents($_SERVER['HOME'].'/.config/valet/config.json'));

            foreach($valetConfig->paths as $path) {
                $composerPath = $path . '/' . str_replace('.' . $valetConfig->tld, '/', $_SERVER['HTTP_HOST']) . 'composer.json';

                if(file_exists($composerPath)) {
                    return $composerPath;
                }
            }
        }

        return $composerJson;
    }
}

try {
    if (! PharLoader::isRunningInLaravelAwareApp()) {
        PharLoader::load(Dump::getPharPath(), [
            'laravel/framework',
            'illuminate/support',
            'symfony/var-dumper',
        ]);
    }

    PharLoader::load(Ray::getPharPath(), [
        'spatie/ray',
        'spatie/yii-ray',
        'spatie/craft-ray',
        'spatie/laravel-ray',
        'spatie/wordpress-ray',
    ]);

    // This empties the global configuration used in Composer autoloader
    // file `autoload_real.php`. Without it, conflicts may appear
    // with projects using same dependencies as this package.
    $GLOBALS['__composer_autoload_files'] = [];
} catch (\Throwable $exception) {
}
