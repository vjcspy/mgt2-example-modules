<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/01
 * @website https://swiftotter.com
 **/

namespace Chapter7\PaymentMethod\Gateway\Config;

use Magento\Payment\Gateway\Config\ValueHandlerInterface;

class CanVoidHandler implements ValueHandlerInterface
{
    public function handle(array $subject, $storeId = null)
    {
        if (!isset($subject['payment'])) {
            return false;
        }

        return true;
    }
}