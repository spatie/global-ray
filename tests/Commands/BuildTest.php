<?php

use Spatie\GlobalRay\Support\Ray;

it('can build the phar', function () {
    $process = executeCommand('global-ray build', 'bin');

    expect($process->isSuccessful())->toBeTrue();

    expect(Ray::getPharPath())->toBeFile();
});
