<?php

it('can install global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, '');

    $ray = implode(DIRECTORY_SEPARATOR, ['.', 'bin', 'global-ray']);

    $process = executeCommand("$ray install --ini={$iniPath}");

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toContain('global-ray-loader.php');

    unlink($iniPath);
});
