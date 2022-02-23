<?php

namespace Spatie\GlobalRay;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class UninstallCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('uninstall')
            ->setDescription('Uninstall Ray globally.')
            ->addOption('ini', null, InputOption::VALUE_REQUIRED, 'The full path to the PHP ini that should be updated');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ini = new PhpIni(
            $input->getOption('ini') ?? get_cfg_var('cfg_file_path')
        );

        $ini->update('auto_prepend_file', null);

        $output->writeln('Successfully updated PHP ini. Global Ray has been uninstalled.');

        return 0;
    }
}
