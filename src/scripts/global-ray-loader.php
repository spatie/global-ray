<?php

try {
    preg_match("#^\d.\d#", PHP_VERSION, $match);

    $version = $match[0];

    $pharPath = realpath(__DIR__ . "/../../ray-phars/ray_php_{$version}.phar");

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
        require_once $pharPath;
    }
} catch (Exception $exception) {

}
