<?php

namespace Spatie\GlobalRay\Support;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class Composer
{
    protected $workingPath;

    public function __construct($workingPath = null)
    {
        $this->setWorkingPath($workingPath);
    }

    public function run(string $command): bool
    {
        $command = array_merge($this->findComposer(), [$command]);

        $process = $this->getProcess($command);

        $process->run();

        return $process->isSuccessful();
    }

    protected function findComposer(): array
    {
        if (file_exists($this->workingPath.'/composer.phar')) {
            return [$this->phpBinary(), 'composer.phar'];
        }

        return ['composer'];
    }

    protected function phpBinary(): string
    {
        return (new PhpExecutableFinder())->find(false);
    }

    protected function getProcess(array $command): Process
    {
        return (new Process($command, $this->workingPath))->setTimeout(null);
    }

    public function setWorkingPath(string $path)
    {
        $this->workingPath = realpath($path);

        return $this;
    }
}
