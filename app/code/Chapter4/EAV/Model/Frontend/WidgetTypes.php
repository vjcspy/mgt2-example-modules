<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter4\EAV\Model\Frontend;

class WidgetTypes extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    public function getLabel()
    {
        $test = 1; // another great place to set a breakpoint.
        return "<b>" . parent::getLabel() . "</b>";
    }
}