<?php

namespace Spatie\GlobalRay\Support;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class Composer
{
    protected $workingPath;

    public function __construct($workingPath = null)
    {
        $this->workingPath = $workingPath;
    }

    public function run($command): int
    {
        $command = array_merge($this->findComposer(), [$command]);

        return $this->getProcess($command)->run();
    }

    protected function findComposer(): array
    {
        if (file_exists($this->workingPath.'/composer.phar')) {
            return [$this->phpBinary(), 'composer.phar'];
        }

        return ['composer'];
    }

    protected function phpBinary(): string|bool
    {
        return (new PhpExecutableFinder)->find(false);
    }

    protected function getProcess(array $command): Process
    {
        return (new Process($command, $this->workingPath))->setTimeout(null);
    }

    public function setWorkingPath($path)
    {
        $this->workingPath = realpath($path);

        return $this;
    }
}