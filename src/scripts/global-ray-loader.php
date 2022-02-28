<?php

use Spatie\GlobalRay\Support\Ray;

try {
    include_once __DIR__ . "/../Support/Ray.php";

    $pharPath = Ray::getPharPath();

    globalRayPharLoader($pharPath, [
        'spatie/ray',
        'spatie/yii-ray',
        'spatie/craft-ray',
        'spatie/laravel-ray',
        'spatie/wordpress-ray',
    ]);

} catch (Throwable $exception) {
}

function globalRayPharLoader(string $pharPath, array $unlessDetectedPackages)
{
    $packages = [
        'spatie/ray',
        'spatie/yii-ray',
        'spatie/craft-ray',
        'spatie/laravel-ray',
        'spatie/wordpress-ray',
    ];

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
