<?php

use Spatie\GlobalRay\Support\Ray;
use Symfony\Component\Process\ExecutableFinder;

it('can build the phar', function () {
    $finder = new ExecutableFinder();

    $ray = $finder->find('global-ray', null, [realpath(__DIR__.'/../../bin')]);

    $process = executeCommand([$ray,  'build']);

    if (! $process->isSuccessful()) {
        var_dump($process->getOutput());
        var_dump($process->getErrorOutput());
        die();
    }

    expect($process->isSuccessful())->toBeTrue();

    expect(Ray::getPharPath())->toBeFile();
});
