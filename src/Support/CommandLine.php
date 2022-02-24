<?php

namespace Spatie\GlobalRay\Support;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class CommandLine
{
    public static function run($command, $cwd, OutputInterface $output): bool
    {
        if (method_exists(Process::class, 'fromShellCommandline')) {
            $process = Process::fromShellCommandline($command, $cwd);
        } else {
            $process = new Process($command, $cwd);
        }

        $process->setTimeout(null)->run(function ($type, $line) use ($output) {
            $output->write($line);
        });

        return $process->isSuccessful();
    }
}
