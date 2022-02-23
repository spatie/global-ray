<?php

namespace Spatie\GlobalRay\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class BuildCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('build')
            ->setDescription('Build the Ray Phar');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Building phar...');

        if (! $this->generateRayPhar($output)) {
            return -1;
        }

        $output->writeln('Successfully built phar.');

        rename(
            $this->getGeneratedRayPharPath(),
            $this->getRestingRayPharPath()
        );

        $output->writeln("Successfully built the Ray Phar at {$this->getRestingRayPharPath()}.");

        return 0;
    }

    protected function generateRayPhar(OutputInterface $output): bool
    {
        $process = Process::fromShellCommandline(
            'composer install && composer build',
            __DIR__.'/../../ray-phar-generator'
        );

        $process->run();

        $output->write($process->getOutput());

        return $process->isSuccessful();
    }

    protected function getGeneratedRayPharPath(): string
    {
        return realpath(__DIR__ . "/../../ray-phar-generator/ray.phar");
    }

    protected function getRestingRayPharPath(): string
    {
        preg_match("#^\d.\d#", PHP_VERSION, $match);

        return __DIR__ . "/../../ray-phars/ray_php_{$match[0]}.phar";
    }
}
