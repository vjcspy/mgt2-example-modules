<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1Before2
{
    public function beforeGet(\Chapter1\Plugins\Model\MyModel $subject, $name, $log)
    {
        $log[] = "Example1Before2 (sort order: 20): Changing name to 'Samuel'";
        return ['Samuel', $log];
    }
}