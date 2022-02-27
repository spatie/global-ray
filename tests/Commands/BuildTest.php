<?php

use Spatie\GlobalRay\Support\Ray;
use Symfony\Component\Process\ExecutableFinder;

it('can build the phar', function () {
    $finder = new ExecutableFinder();

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        chdir(realpath(__DIR__.'/../../bin'));

        $ray = $finder->find('global-ray');
    } else {
        $ray = $finder->find('global-ray', null, [realpath(__DIR__.'/../../bin')]);
    }

    $process = executeCommand([$ray,  'build']);

    if (! $process->isSuccessful()) {
        var_dump($process->getOutput());
        var_dump($process->getErrorOutput());
        die();
    }

    expect($process->isSuccessful())->toBeTrue();

    expect(Ray::getPharPath())->toBeFile();
});
