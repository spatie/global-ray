<?php

it('can install global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, '');

    $process = executeCommand("global-ray install --ini {$iniPath}", 'bin');

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toContain('global-ray-loader.php');

    unlink($iniPath);
});
