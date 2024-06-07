<?php

namespace Spatie\GlobalRay\Commands;

use Exception;
use Spatie\GlobalRay\Support\Composer;
use Spatie\GlobalRay\Support\Dump;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Building phars...');

        $composerDirectory = __DIR__.'/../../ray-phar-generator';
        $temporaryDestination = __DIR__ . "/../../ray-phar-generator/ray.phar";
        $finalDestination = Ray::getPharPath();
        $this->generatePhar($composerDirectory, $temporaryDestination, $finalDestination);

        $output->writeln('Successfully built Ray Phar.');

        $composerDirectory = __DIR__.'/../../dump-phar-generator';
        $temporaryDestination = __DIR__ . "/../../dump-phar-generator/dump.phar";
        $finalDestination = Dump::getPharPath();
        $this->generatePhar($composerDirectory, $temporaryDestination, $finalDestination);

        $output->writeln('Successfully built Dump Phar.');

        return 0;
    }

    protected function generatePhar(string $composerPath, string $temporaryDestination,  string $finalDestination)
    {
        $composer = new Composer($composerPath);

        if (! $composer->run('update')) {
            throw new Exception('Could not generate phar');
        }

        $composer->run('build');

        $result = rename(
            $temporaryDestination,
            $finalDestination
        );

        if (! $result) {
            throw new Exception('Could not generate phar');
        }
    }
}
