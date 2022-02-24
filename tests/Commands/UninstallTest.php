<?php

use Spatie\GlobalRay\Commands\UninstallCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

it('can uninstall global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, 'auto_prepend_file = loader.php');

    $app = new Application('Global Ray Installer');

    $app->add(new UninstallCommand());

    $tester = new CommandTester($app->find('uninstall'));

    $statusCode = $tester->execute(['--ini' => $iniPath]);

    expect($statusCode)->toBe(0);

    expect(trim(file_get_contents($iniPath)))->toBe("auto_prepend_file =");

    unlink($iniPath);
});
