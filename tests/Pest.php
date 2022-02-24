<?php

use Symfony\Component\Process\Process;

beforeEach(function () {
    file_put_contents(getIniPath(), '');
});

afterEach(function () {
    unlink(getIniPath());
});

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
