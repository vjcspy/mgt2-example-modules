<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\WebApiOverride\Endpoint;

use Chapter3\WebApiOverride\Api\OverrideInterface;

class Override implements OverrideInterface
{
    public function sayHello(string $firstName, $lastName)
    {
        return (string)__('(GET) Hello, %1 %2!', $firstName, $lastName);
    }

    public function doPost(string $firstName, $lastName)
    {
        return (string)__('(POST) Hello, %1 %2!', $firstName, $lastName);
    }

    public function testRef()
    {
        return "Worked!";
    }
}