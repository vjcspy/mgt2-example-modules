<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Challenge12PluginDebug\Model;

class MyModel
{
    public function get(string $name)
    {
        return "Hello, " . $this->format($name);
    }

    private function format(string $name)
    {
        return "<b>${name}</b>";
    }
}