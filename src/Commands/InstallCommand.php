<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\PhpIni;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Install Spatie Ray globally.')
            ->addOption('ini', null, InputOption::VALUE_REQUIRED, 'The full path to the PHP ini that should be updated');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ini = new PhpIni($input->getOption('ini'));

        $output->writeln("Updating PHP ini: {$ini->getPath()}");

        if (! $ini->update('auto_prepend_file', $this->getLoaderPath())) {
            $output->writeln('Unable to update PHP ini.');

            return -1;
        }

        $output->writeln('Successfully updated PHP ini. Global Ray has been installed.');

        return 0;
    }

    protected function getLoaderPath(): string
    {
        return realpath(__DIR__ . "/../scripts/global-ray-loader.php");
    }
}
