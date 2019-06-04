<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1After1
{
    public function afterGet(\Chapter1\Plugins\Model\MyModel $subject, $output, $name, $log)
    {
        $output['log'][] = "Example1After1 (sort order: 40): Adding name, Mike.";
        $output['statement'] .= ' (and Mike)';

        return $output;
    }
}