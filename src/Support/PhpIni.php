<?php

namespace Spatie\GlobalRay\Support;

use Exception;

class PhpIni
{
    protected $path;

    public function __construct(string $path = null)
    {
        if (! $path) {
            $path = get_cfg_var('cfg_file_path');
        }

        if (! file_exists($path)) {
            throw new Exception("PHP ini file not found at path: {$path}");
        }

        $this->path = $path;
    }

    public function update(string $optionName, ?string $value): bool
    {
        $contents = file_get_contents($this->path);

        $option = "{$optionName} = {$value}\n";

        if ($line = $this->findOptionLine($optionName)) {
            $contents = str_replace($line, $option, $contents);
        } else {
            $contents = $option . $contents;
        }

        return is_int(file_put_contents($this->path, $contents));
    }

    public function getContents()
    {
        return file_get_contents($this->path);
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * Find the option's line.
     *
     * @param string $option
     *
     * @return string|false
     */
    protected function findOptionLine($option)
    {
        $lines = file($this->path);

        foreach ($lines as $line) {
            if (strpos($line, $option) !== false) {
                return $line;
            }
        }

        return false;
    }
}
