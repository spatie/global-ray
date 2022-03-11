<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\PhpIni;
use Spatie\GlobalRay\Support\Platform;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

trait RetriesAsWindowsAdmin
{
    protected function shouldRetryAsWindowsAdmin(PhpIni $ini, InputInterface $input): bool
    {
        return ! is_writeable($ini->getPath())
            && $input->isInteractive()
            && Platform::isWindowsNonAdminUser();
    }

    protected function retryAsWindowsAdmin(PhpIni $ini, InputInterface $input, OutputInterface $output): bool
    {
        $question = new ConfirmationQuestion('   Retry as Adminstrator? (Y/n)', false);

        if (! $this->getHelper('question')->ask($input, $output, $question)) {
            return false;
        }

        $tmpFile = tempnam(sys_get_temp_dir(), '');

        file_put_contents($tmpFile, $ini->getContents());

        $newIni = new PhpIni($tmpFile);

        $newIni->update('auto_prepend_file', $this->getLoaderPath());

        return $this->tryCopyAsWindowsAdmin($newIni->getPath(), $ini->getPath());
    }

    protected function tryCopyAsWindowsAdmin(string $source, string $destination): bool
    {
        $tmpFile = tempnam(sys_get_temp_dir(), '');
        $script = $tmpFile.'.vbs';
        rename($tmpFile, $script);

        $source = str_replace('/', '\\', $source);
        $destination = str_replace('/', '\\', $destination);

        $vbs = <<<EOT
Set UAC = CreateObject("Shell.Application")
UAC.ShellExecute "cmd.exe", "/c copy /b /y ""$source"" ""$destination""", "", "runas", 0
Wscript.Sleep(300)
EOT;

        file_put_contents($script, $vbs);
        exec('"'.$script.'"');
        @unlink($script);

        if ($result = is_readable($destination)) {
            @unlink($source);
        }

        return $result;
    }
}
