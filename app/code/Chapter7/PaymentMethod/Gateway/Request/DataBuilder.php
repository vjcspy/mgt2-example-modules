<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/01
 * @website https://swiftotter.com
 **/

namespace Chapter7\PaymentMethod\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Payment\Helper\Formatter;

class DataBuilder implements BuilderInterface
{
    use Formatter;

    const AMOUNT = 'amount';

    const PAYMENT_SENDER_NUMBER = 'paymentSenderNumber';

    public function build(array $buildSubject)
    {
        $output = [
            self::AMOUNT => $this->formatPrice($buildSubject['amount']),
            self::PAYMENT_SENDER_NUMBER => $buildSubject['payment']->getPayment()->getAdditionalInformation(self::PAYMENT_SENDER_NUMBER)
        ];

        return $output;
    }
}