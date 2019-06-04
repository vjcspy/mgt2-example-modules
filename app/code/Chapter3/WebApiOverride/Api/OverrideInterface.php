<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\WebApiOverride\Api;

interface OverrideInterface
{
    /**
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function sayHello(string $firstName, $lastName);

    /**
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function doPost(string $firstName, $lastName);

    /**
     * @return string
     */
    public function testRef();
}