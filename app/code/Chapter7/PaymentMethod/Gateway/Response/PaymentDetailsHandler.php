<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/01
 * @website https://swiftotter.com
 **/

namespace Chapter7\PaymentMethod\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Sales\Api\Data\OrderPaymentInterface;

class PaymentDetailsHandler implements HandlerInterface
{
    public function handle(array $handlingSubject, array $response)
    {
        if (!isset($handlingSubject['payment'])) {
            return false;
        }

        /** @var OrderPaymentInterface $payment */
        $payment = $handlingSubject['payment'];

        foreach ($response as $key => $value) {
            $payment->getPayment()->setAdditionalInformation($key, $value);
        }
    }
}