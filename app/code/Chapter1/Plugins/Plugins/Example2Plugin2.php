<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Plugins;

class Example2Plugin2
{
    public function beforeBeforeFormat(
        \Chapter1\Plugins\Model\Plugins\Example2Plugin1 $subject,
        \Chapter1\Plugins\Model\MyModel $model,
        $name
    ) {
        return [$model, $name . ', Elissa (plugin modifier)'];
    }
}