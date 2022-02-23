<?php

it('can uninstall global ray', function() {
    $iniPath = getIniPath();

    $process = executeCommand("./bin/global-ray uninstall --ini={$iniPath}");

    expect($process->isSuccessful())->toBeTrue();

    expect(file_get_contents($iniPath))->toBe('auto_prepend_file = ' . PHP_EOL);
});
