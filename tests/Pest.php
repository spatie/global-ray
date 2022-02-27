<?php

use Symfony\Component\Process\Process;

function executeCommand(string $command, string $cwd = null): Process
{
    $process = Process::fromShellCommandline($command, $cwd);

    $process->setTimeout(null);

    $process->run();

    return $process;
}

function getIniPath()
{
    return __DIR__ . '/temp/php.ini';
}
