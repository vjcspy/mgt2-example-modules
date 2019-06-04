<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1After2
{
    public function afterGet(\Chapter1\Plugins\Model\MyModel $subject, $output, $name, $log)
    {
        $output['log'][] = "Example1After2 (sort order: 50): Adding punctuation.";
        $output['statement'] .= '!';

        return $output;
    }
}