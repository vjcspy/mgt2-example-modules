<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CLI\Observers;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SampleEvent implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        echo 'Executed (in frontend)!';
    }
}