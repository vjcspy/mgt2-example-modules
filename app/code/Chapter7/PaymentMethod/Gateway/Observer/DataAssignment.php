<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/02
 * @website https://swiftotter.com
 **/

namespace Chapter7\PaymentMethod\Gateway\Observer;

use Chapter7\PaymentMethod\Gateway\Request\DataBuilder;
use Magento\Framework\Event\Observer;
use Magento\Payment\Observer\AbstractDataAssignObserver;
use Magento\Quote\Api\Data\PaymentInterface;

class DataAssignment extends AbstractDataAssignObserver
{
    public function execute(Observer $observer)
    {
        $data = $this->readDataArgument($observer);
        $additionalData = $data->getData(PaymentInterface::KEY_ADDITIONAL_DATA);
        if (!is_array($additionalData)) {
            return;
        }

        $paymentInfo = $this->readPaymentModelArgument($observer);

        if (!isset($additionalData[DataBuilder::PAYMENT_SENDER_NUMBER])) {
            return;
        }

        $paymentInfo->setAdditionalInformation(DataBuilder::PAYMENT_SENDER_NUMBER, $additionalData[DataBuilder::PAYMENT_SENDER_NUMBER]);
    }
}