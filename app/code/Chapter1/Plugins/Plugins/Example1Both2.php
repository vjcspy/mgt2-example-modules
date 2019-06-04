<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1Both2
{
    public function beforeGet(\Chapter1\Plugins\Model\MyModel $subject, $name, $log)
    {
        $log[] = "Example1Both2 (sort order: 55): Changing name to 'Kyle'";
        return ['Joseph', $log];
    }

    public function afterGet(\Chapter1\Plugins\Model\MyModel $subject, $output, $name, $log)
    {
        $output['log'][] = "Example1Both2 (sort order: 55): Adding smiley face.";
        $output['statement'] .= '😊';

        return $output;
    }
}