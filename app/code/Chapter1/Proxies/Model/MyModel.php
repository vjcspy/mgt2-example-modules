<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Proxies\Model;

class MyModel
{
    private $myProxiedClass;

    public function __construct(MyProxiedClass $myProxiedClass)
    {
        $this->myProxiedClass = $myProxiedClass;
    }

    public function get(string $name)
    {
        return $this->myProxiedClass->format('Hello, ' . $name);
    }

    public function format(string $name)
    {
        return '<b>' . $name . '</b>';
    }
}