<?php

use Symfony\Component\Process\Process;

function executeCommand(string $command): Process
{
    $process = Process::fromShellCommandline($command);

    $process->run();

    return $process;
}

function getIniPath()
{
    return __DIR__ . '/temp/php.ini';
}
