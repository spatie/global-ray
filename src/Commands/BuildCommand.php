<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\Composer;
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
            $output->writeln('Failed generating phar.');

            return -1;
        }

        $output->writeln('Successfully built phar.');

        $rayRestingPharPath = Ray::getPharPath();

        $renamed = rename(
            $this->getGeneratedRayPharPath(),
            $rayRestingPharPath
        );

        if (! $renamed) {
            $output->writeln('Failed renaming generated phar.');

            return -1;
        }

        $output->writeln("Successfully built the Ray Phar at {$rayRestingPharPath}.");

        return 0;
    }

    protected function generateRayPhar(): bool
    {
        $composer = new Composer(__DIR__.'/../../ray-phar-generator');

        if ($composer->run('update') === 0) {
            return $composer->run('build') === 0;
        }

        return false;
    }

    protected function getGeneratedRayPharPath(): string
    {
        return realpath(__DIR__ . "/../../ray-phar-generator/ray.phar");
    }
}
