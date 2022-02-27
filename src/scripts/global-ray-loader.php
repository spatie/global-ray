<?php

try {
    include __DIR__ . "/../Support/Ray.php";
    
    $pharPath = \Spatie\GlobalRay\Support\Ray::getPharPath();

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
                if (in_array($package, $packages)) {
                    return;
                }
            }
        }
    }

    if (file_exists($pharPath)) {
        include $pharPath;
    }
} catch (Throwable $exception) {
}
