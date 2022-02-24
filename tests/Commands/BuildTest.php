<?php

use Spatie\GlobalRay\Support\Ray;
use Spatie\GlobalRay\Commands\BuildCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

it('can build the phar', function () {
    $app = new Application('Global Ray Installer');

    $app->add(new BuildCommand());

    $tester = new CommandTester($app->find('build'));

    $statusCode = $tester->execute([]);

    expect($statusCode)->toBe(0);

    expect(Ray::getPharPath())->toBeFile();
});
