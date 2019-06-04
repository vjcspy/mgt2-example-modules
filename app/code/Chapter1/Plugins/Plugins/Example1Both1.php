<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1Both1
{
    public function beforeGet(\Chapter1\Plugins\Model\MyModel $subject, $name, $log)
    {
        $log[] = "Example1Both1 (sort order: 15): Changing name to 'Stacy'";
        return ['Joseph', $log];
    }

    public function afterGet(\Chapter1\Plugins\Model\MyModel $subject, $output, $name, $log)
    {
        $output['log'][] = "Example1Both1 (sort order: 15): Adding exclamation mark.";
        $output['statement'] .= '!';

        return $output;
    }
}