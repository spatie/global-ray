<?php

it('can uninstall global ray', function () {
    $iniPath = getIniPath();

    file_put_contents($iniPath, 'auto_prepend_file = loader.php');

    $process = executeCommand("\"./bin/global-ray\" uninstall --ini {$iniPath}");

    expect($process->isSuccessful())->toBeTrue();

    expect(trim(file_get_contents($iniPath)))->toBe("auto_prepend_file =");

    unlink($iniPath);
});
