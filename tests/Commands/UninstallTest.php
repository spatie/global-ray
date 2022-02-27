<?php

use Symfony\Component\Process\ExecutableFinder;

it('can uninstall global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, 'auto_prepend_file = loader.php');

    $finder = new ExecutableFinder();

    $ray = $finder->find('global-ray', null, [realpath(__DIR__.'/../../bin')]);

    $process = executeCommand([$ray, 'uninstall', "--ini", $iniPath]);

    expect($process->isSuccessful())->toBeTrue();

    expect(trim(file_get_contents($iniPath)))->toBe("auto_prepend_file =");

    unlink($iniPath);
});
