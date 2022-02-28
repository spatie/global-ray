<?php

use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use Spatie\GlobalRay\Support\Platform;

function executeGlobalRay(string $command, array $args = []): Process
{
    if (Platform::isWindows()) {
        $process = executeCommand(
            array_merge(['php', 'global-ray',  $command], $args),
            realpath(__DIR__.'/../bin')
        );
    } else {
        $finder = new ExecutableFinder();

        $ray = $finder->find('global-ray', null, [realpath(__DIR__.'/../bin')]);

        $process = executeCommand(array_merge([$ray,  $command], $args));
    }

    return $process;
}

function executeCommand(array $command, string $cwd = null): Process
{
    $process = new Process($command, $cwd);

    $process->setTimeout(null);

    $process->run();

    return $process;
}

function getIniPath()
{
    return __DIR__ . '/temp/php.ini';
}
