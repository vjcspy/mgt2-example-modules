<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1Before1
{
    public function beforeGet(\Chapter1\Plugins\Model\MyModel $subject, $name, $log)
    {
        $log[] = "Example1Before1 (sort order: 10): Changing name to 'Joseph'";
        return ['Joseph', $log];
    }
}