<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/25
 * @website https://swiftotter.com
 **/

namespace Chapter2\Layout\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Welcome implements ArgumentInterface
{
    public function getWelcome()
    {
        return "Hello, world #" . rand(1, 100);
    }
}