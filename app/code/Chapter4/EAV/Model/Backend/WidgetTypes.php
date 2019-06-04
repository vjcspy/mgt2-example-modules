<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter4\EAV\Model\Backend;

class WidgetTypes extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    public function beforeSave($object)
    {
        $test = 1; // great place to drop a breakpoint for observation.
        return parent::beforeSave($object);
    }
}