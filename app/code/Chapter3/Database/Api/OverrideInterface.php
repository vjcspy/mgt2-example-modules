<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Api;

interface OverrideInterface
{
    /**
     * @param string $name
     * @return string
     */
    public function sayHello(string $name);

    /**
     * @param string $name
     * @return string
     */
    public function doPost(string $name);
}