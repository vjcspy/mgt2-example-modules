<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/01
 * @website https://swiftotter.com
 **/

namespace Chapter7\PaymentMethod\Gateway\Http\Client;

use Magento\Payment\Gateway\Http\ClientInterface;
use Magento\Payment\Gateway\Http\TransferInterface;

class TransactionSale implements ClientInterface
{
    public function placeRequest(TransferInterface $transferObject)
    {
        return ['success' => true];
    }
}