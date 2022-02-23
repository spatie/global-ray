<?php

use Spatie\GlobalRay\Support\Ray;

it('can build the phar', function () {
    $process = executeCommand('./bin/global-ray build');

    expect($process->isSuccessful())->toBeTrue();

    expect(Ray::getPharPath())->toBeFile();
});
