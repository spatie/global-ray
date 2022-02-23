<?php

namespace Spatie\GlobalRay;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

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
        $ini = new PhpIni(
            $input->getOption('ini') ?? get_cfg_var('cfg_file_path')
        );

        // Before installing, we will make sure to clear the option
        // inside of the ini so we can safely replace the phar without
        // PHP crashing.
        $ini->update('auto_prepend_file', null);

        if (! file_exists($this->getRestingRayPharPath())) {
            $output->writeln('Building phar...');

            if (! $this->generateRayPhar($output)) {
                return -1;
            }

            $output->writeln('Successfully built phar.');

            rename(
                $this->getGeneratedRayPharPath(),
                $this->getRestingRayPharPath()
            );
        }

        $output->writeln("Updating PHP ini: {$ini->getPath()}");

        $ini->update('auto_prepend_file', $this->getLoaderPath());

        $output->writeln('Successfully updated PHP ini. Global Ray has been installed.');

        return 0;
    }

    protected function generateRayPhar(OutputInterface $output): bool
    {
        $process = Process::fromShellCommandline(
            'composer install && composer build',
            __DIR__.'/../generator'
        );

        $process->run();

        $output->write($process->getOutput());

        return $process->isSuccessful();
    }

    protected function getLoaderPath(): string
    {
        return __DIR__ . "/../loader.php";
    }

    protected function getGeneratedRayPharPath(): string
    {
        return __DIR__ . "/../generator/ray.phar";
    }

    protected function getRestingRayPharPath(): string
    {
        preg_match("#^\d.\d#", PHP_VERSION, $match);

        return __DIR__ . "/../generator/phars/ray_php_{$match[0]}.phar";
    }
}
