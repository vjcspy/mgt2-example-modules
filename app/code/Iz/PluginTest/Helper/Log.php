<?php

namespace Iz\PluginTest\Helper;

class Log
{
    const FILE = "plugin_test.txt";

    /**
     * Log constructor.
     */
    public function __construct()
    {
        try {
            unlink(Log::FILE);
        } catch (\Exception $exception) {
        }
    }

    public function write($string)
    {
        $handle = fopen(Log::FILE, 'a') or die('Cannot open file:  ' . Log::FILE);
        $new_data = "\n" . $string;
        fwrite($handle, $new_data);
        fclose($handle);
    }
}
