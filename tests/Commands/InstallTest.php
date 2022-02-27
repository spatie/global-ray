<?php

it('can install global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, '');

    $process = executeGlobalRay('install', ['--ini', $iniPath]);

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toContain('global-ray-loader.php');

    unlink($iniPath);
});
