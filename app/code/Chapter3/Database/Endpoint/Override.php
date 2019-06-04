<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Endpoint;

use Chapter3\Database\Api\OverrideInterface;

class Override implements OverrideInterface
{
    public function sayHello(string $name)
    {
        return (string)__('(GET) Hello, %1 no last name!', $name);
    }

    public function doPost(string $name)
    {
        return (string)__('(POST) Hello, %1 no last name!', $name);
    }
}