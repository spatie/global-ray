<?php

use Spatie\GlobalRay\Support\Ray;

it('can build the phar', function () {
    $ray = implode(DIRECTORY_SEPARATOR, ['.', 'bin', 'global-ray']);

    $process = executeCommand("$ray build");

    expect($process->isSuccessful())->toBeTrue();

    expect(Ray::getPharPath())->toBeFile();
});
