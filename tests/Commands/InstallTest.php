<?php

use Symfony\Component\Process\ExecutableFinder;

it('can install global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, '');

    $finder = new ExecutableFinder();

    $ray = $finder->find('global-ray', null, [realpath(__DIR__.'/../../bin')]);

    $process = executeCommand([$ray, 'install', '--ini', $iniPath]);

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toContain('global-ray-loader.php');

    unlink($iniPath);
});
