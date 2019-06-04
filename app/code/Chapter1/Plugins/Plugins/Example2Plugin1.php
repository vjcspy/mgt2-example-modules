<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example2Plugin1
{
    public function beforeFormat(\Chapter1\Plugins\Model\MyModel $subject, $name)
    {
        return [$name . ', Calia (original plugin)'];
    }
}