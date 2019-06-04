<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Challenge12PluginDebug\Model\Plugin;

class ChangeInputName
{
    public function beforeGet(\Chapter1\Challenge12PluginDebug\Model\MyModel $subject, $name)
    {
        return ['Elissa'];
    }

    public function afterFormat(\Chapter1\Challenge12PluginDebug\Model\MyModel $subject, $result)
    {
        return '<i>' . $result . '</i>';
    }
}