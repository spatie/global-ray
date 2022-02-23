<?php

namespace Stevebauman\SpatieGlobalRay;

use Exception;

class PhpIni
{
    /**
     * The PHP ini path.
     *
     * @var string
     */
    protected $path;

    /**
     * Constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        if (! file_exists($path)) {
            throw new Exception('PHP ini file not found at path: ' . $path);
        }

        $this->path = $path;
    }

    /**
     * Update the PHP ini option.
     *
     * @param string $option
     * @param string|null $value
     *
     * @return void
     */
    public function update($optionName, $value = null)
    {
        $contents = file_get_contents($this->path);

        $option = "{$optionName} = {$value}\n";

        if ($line = $this->findOptionLine($optionName)) {
            $contents = str_replace($line, $option, $contents);
        } else {
            $contents = $option . $contents;
        }
    
        file_put_contents($this->path, $contents);
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
