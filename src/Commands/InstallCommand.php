<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\PhpIni;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class InstallCommand extends Command
{
    use ConfirmsPhpIniPath;
    use RetriesAsWindowsAdmin;

    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Install Spatie Ray globally.')
            ->addOption('ini', null, InputOption::VALUE_REQUIRED, 'The full path to the PHP ini that should be updated');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('');
        $output->writeln('   ⚡️ Ray is a wonderful desktop application that will let you');
        $output->writeln('   debug your applications faster.');
        $output->writeln('');
        $output->writeln('   🌎 For more info visit: <href=https://myray.app>https://myray.app</>');
        $output->writeln('');
        $output->writeln('   💪 By installing global-ray you will be able to use');
        $output->writeln('   these functions in any PHP script: ray(), rd(), dump(), dd()');
        $output->writeln('   ');
        $output->writeln('   You can chain a lot of useful functions on ray()');
        $output->writeln('   - ray()->green(): colorize the output in Ray');
        $output->writeln('   - ray()->pause(): pause your code');
        $output->writeln('   - ray()->measure(): quickly measure runtime and memory');
        $output->writeln('   - ray()->trace(): see where your function is being called');
        $output->writeln('   - ray()->charles(): Let\'s dance!');
        $output->writeln('');
        $output->writeln('   📗 You can see more Ray functions in the docs:');
        $output->writeln('   <href=https://spatie.be/docs/ray/v1/usage/framework-agnostic-php-project>https://spatie.be/docs/ray/v1/usage/framework-agnostic-php-project</>');
        $output->writeln('');

        $question = new ConfirmationQuestion('   🤙 Do you wish to install Ray globally? (Y/n) > ', true);

        if (! $this->getHelper('question')->ask($input, $output, $question)) {
            $output->writeln('   Cancelling...');

            return 0;
        }

        $ini = new PhpIni(
            $this->findPhpIniPath($input, $output)
        );

        $output->writeln("   Updating PHP ini: {$ini->getPath()}...");
        $output->writeln('');
        $output->writeln('');
        $output->writeln('');

        if ($ini->update('auto_prepend_file', $this->getLoaderPath())) {
            $this->displaySuccessfulInstallation($output);

            return 0;
        }

        if (! $this->shouldRetryAsWindowsAdmin($ini, $input)) {
            $output->writeln('   ❌ Unable to update PHP ini.');

            $this->displayManualInstallation($output, $ini);

            return -1;
        }

        $output->writeln('   ❌ Unable to update PHP ini. Access is denied.');

        if (! $this->retryAsWindowsAdmin($ini, $input, $output)) {
            $output->writeln('   ❌ Failed updating PHP ini.');

            $this->displayManualInstallation($output, $ini);

            return -1;
        }

        $this->displaySuccessfulInstallation($output);

        return 0;
    }

    protected function displaySuccessfulInstallation(OutputInterface $output)
    {
        $output->writeln('   ✅ Successfully updated PHP ini. Global Ray has been installed.');
        $output->writeln('');
        $output->writeln('   ⚡️ Get your Ray license at <href=https://myray.app>https://myray.app</>');
        $output->writeln('   Happy debugging!');
        $output->writeln('');
    }

    protected function displayManualInstallation(OutputInterface $output, PhpIni $ini)
    {
        $output->writeln('');
        $output->writeln("   To install manually, paste the below option into your PHP ini configuration file: {$ini->getPath()}...");
        $output->writeln('');
        $output->writeln("auto_prepend_file = {$this->getLoaderPath()}");
        $output->writeln('');
    }

    protected function getLoaderPath(): string
    {
        return realpath(__DIR__ . "/../scripts/global-ray-loader.php");
    }
}
