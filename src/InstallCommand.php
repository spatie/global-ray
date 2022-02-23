<?php

namespace Stevebauman\SpatieGlobalRay;

use TitasGailius\Terminal\Terminal;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends Command
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Install Spatie Ray globally.')
            ->addOption('ini', null, InputOption::VALUE_REQUIRED, 'The full path to the PHP ini that should be updated');
    }

    /**
     * Execute the command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ini = new PhpIni(
            $input->getOption('ini') ?? get_cfg_var('cfg_file_path')
        );

        // Before installing, we will make sure to clear the
        // option inside of the ini so we can safely
        // replace the phar without PHP crashing.
        $ini->update('auto_prepend_file', null);

        if (! file_exists($this->getRestingRayPharPath())) {
            if (! $this->generateRayPhar($output)) {
                return static::FAILURE;
            }

            rename(
                $this->getGeneratedRayPharPath(),
                $this->getRestingRayPharPath()
            );
        }

        $ini->update('auto_prepend_file', $this->getLoaderPath());
        
        return static::SUCCESS;
    }

    /**
     * Generate the Spatie Ray phar.
     *
     * @param OutputInterface $output
     *
     * @return bool
     */
    protected function generateRayPhar(OutputInterface $output)
    {
        $result = Terminal::builder()
            ->output($output)
            ->in(__DIR__.'/../generator')
            ->run('composer install && composer build');

        return $result->successful();
    }

    /**
     * Get the path to the ray loader file.
     *
     * @return string
     */
    protected function getLoaderPath()
    {
        return __DIR__ . "/../loader.php";
    }

    /**
     * Get the generated ray phar path.
     *
     * @return string
     */
    protected function getGeneratedRayPharPath()
    {
        return __DIR__ . "/../generator/ray.phar";
    }

    /**
     * Get the generated ray phar path.
     *
     * @return string
     */
    protected function getRestingRayPharPath()
    {
        preg_match("#^\d.\d#", PHP_VERSION, $match);

        return __DIR__ . "/../generator/phars/ray_php_{$match[0]}.phar";
    }
}
