<?php

return [
    'prefix' => 'GlobalRay',
    'expose-functions' => ['ray', 'rd'],
    'patchers' => [
        function (string $filePath, string $prefix, string $content) {
            if (strpos($filePath, 'composer.json') !== false) {
                $json = json_decode($content, true);
                $json['config']['autoloader-suffix'] = 'GlobalRay';

                return json_encode($json);
            }

            return $content;
        },
    ],
];
