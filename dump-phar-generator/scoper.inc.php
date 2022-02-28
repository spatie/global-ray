<?php

return [
    'prefix' => 'GlobalDump',
    'expose-functions' => ['dump', 'dd'],
    'patchers' => [
        function (string $filePath, string $prefix, string $content) {
            if (strpos($filePath, 'composer.json') !== false) {
                $json = json_decode($content, true);
                $json['config']['autoloader-suffix'] = 'GlobalDump';

                return json_encode($json);
            }

            return $content;
        },
    ],
];
