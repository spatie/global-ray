<?php

it('can uninstall global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, '');

    $ray = implode(DIRECTORY_SEPARATOR, ['.', 'bin', 'global-ray']);

    $process = executeCommand("$ray uninstall --ini={$iniPath}");

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toBe('auto_prepend_file = ' . PHP_EOL);

    unlink($iniPath);
});
