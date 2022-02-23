<?php

it('can install global ray', function () {
    $iniPath = getIniPath();

    $process = executeCommand("./bin/global-ray install --ini={$iniPath}");

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toContain('global-ray-loader.php');
});
