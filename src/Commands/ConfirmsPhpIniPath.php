<?php

namespace Spatie\GlobalRay\Commands;

use Spatie\GlobalRay\Support\PhpIni;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

trait ConfirmsPhpIniPath
{
    protected function findPhpIniPath(InputInterface $input, OutputInterface $output): string
    {
        if ($iniPath = $input->getOption('ini')) {
            return $iniPath;
        }

        if (count($iniPaths = PhpIni::loaded()) === 1) {
            return reset($iniPaths);
        }

        $question = new ChoiceQuestion('   Multiple loaded PHP ini files have been found. Which one would you like to update?', $iniPaths);

        return $this->getHelper('question')->ask($input, $output, $question);
    }
}
