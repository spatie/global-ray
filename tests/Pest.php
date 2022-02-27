<?php

use Symfony\Component\Process\Process;

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
