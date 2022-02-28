<?php

use Spatie\GlobalRay\Support\Dump;
use Spatie\GlobalRay\Support\Ray;

try {
    include_once __DIR__ . "/../Support/Ray.php";
    $rayPharPath = Ray::getPharPath();
    globalRayPharLoader($rayPharPath, [
        'spatie/ray',
        'spatie/yii-ray',
        'spatie/craft-ray',
        'spatie/laravel-ray',
        'spatie/wordpress-ray',
    ]);

    include_once __DIR__ . "/../Support/Dump.php";
    $dumpPharPath = Dump::getPharPath();
    globalRayPharLoader($dumpPharPath, [
        'laravel/framework',
        'illuminate/support',
        'symfony/var-dumper'
    ]);

} catch (Throwable $exception) {
}

function globalRayPharLoader(string $pharPath, array $unlessDetectedPackages)
{
    $composerJson = getcwd() . '/composer.json';

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
