<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example1Around1
{
    public function aroundGet(\Chapter1\Plugins\Model\MyModel $subject, callable $proceed, string $name, array $log)
    {
        $log[] = 'Example1Around1 (sort order: 30, before): Changing name to "Emily".';
        $output = $proceed('Emily', $log);
        $output['log'][] = 'Example1Around1 (sort order: 30, after): Adding log entry.';

        return $output;
    }
}