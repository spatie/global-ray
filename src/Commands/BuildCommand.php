<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\CommandLine;
use Spatie\GlobalRay\Support\Ray;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        $rayRestingPharPath = Ray::getPharPath();

        rename(
            $this->getGeneratedRayPharPath(),
            $rayRestingPharPath
        );

        $output->writeln("Successfully built the Ray Phar at {$rayRestingPharPath}.");

        return 0;
    }

    protected function generateRayPhar(OutputInterface $output): bool
    {
        return CommandLine::run(
            'composer update && composer build',
            __DIR__.'/../../ray-phar-generator',
            $output
        );
    }

    protected function getGeneratedRayPharPath(): string
    {
        return realpath(__DIR__ . "/../../ray-phar-generator/ray.phar");
    }
}
