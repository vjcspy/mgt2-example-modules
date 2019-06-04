<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/01
 * @website https://swiftotter.com
 **/

namespace Chapter7\PaymentMethod\Gateway\Http;

use Magento\Payment\Gateway\Http\TransferBuilder;
use Magento\Payment\Gateway\Http\TransferFactoryInterface;

class TransferFactory implements TransferFactoryInterface
{
    private $transferBuilder;

    public function __construct(TransferBuilder $transferBuilder)
    {
        $this->transferBuilder = $transferBuilder;
    }

    public function create(array $request)
    {
        return $this->transferBuilder->setBody($request)->build();
    }
}