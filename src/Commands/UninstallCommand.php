<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\PhpIni;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UninstallCommand extends Command
{
    use RetriesAsWindowsAdmin;

    protected function configure()
    {
        $this
            ->setName('uninstall')
            ->setDescription('Uninstall Ray globally.')
            ->addOption('ini', null, InputOption::VALUE_REQUIRED, 'The full path to the PHP ini that should be updated');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ini = new PhpIni($input->getOption('ini'));


        $output->writeln('');
        $output->writeln("  Updating PHP ini: {$ini->getPath()}...");
        $output->writeln('');

        if ($ini->update('auto_prepend_file', null)) {
            $output->writeln('  👋 Successfully updated PHP ini. Global Ray has been uninstalled.');
            $output->writeln('');

            return 0;
        }

        if (! $this->shouldRetryAsWindowsAdmin($ini, $input)) {
            $output->writeln('  ❌ Unable to update PHP ini.');
            $output->writeln('');

            return -1;
        }

        $output->writeln('  ❌ Unable to update PHP ini. Access is denied.');

        if (! $this->retryAsWindowsAdmin($ini, $input, $output)) {
            $output->writeln('  ❌ Failed updating PHP ini.');
            $output->writeln('');

            return -1;
        }

        $output->writeln('   👋 Successfully updated PHP ini. Global Ray has been uninstalled.');
        $output->writeln('');

        return 0;
    }
}
