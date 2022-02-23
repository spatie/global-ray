<?php

use Spatie\GlobalRay\Support\Ray;
use Symfony\Component\Process\Process;

it('build the phar', function () {
   $process = executeCommand('./bin/global-ray build');

   expect($process->isSuccessful())->toBeTrue();

   expect(Ray::getPharPath())->toBeFile();
});

function executeCommand(string $command): Process
{
    $process =  Process::fromShellCommandline($command);

    $process->run();

    return $process;
}
