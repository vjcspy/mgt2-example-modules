<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Model;

class MyModel
{
    public function get(string $name, array $log)
    {
        return [
            'statement' => 'Hello, ' . $name,
            'log' => $log
        ];
    }

    public function format(string $name)
    {
        return strtoupper($name);
    }
}