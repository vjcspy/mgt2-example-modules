<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\ConfigLoadOrder\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var RawFactory */
    private $rawFactory;

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(
        Context $context,
        RawFactory $rawFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->rawFactory = $rawFactory;
        $this->scopeConfig = $scopeConfig;

        parent::__construct($context);
    }

    public function execute()
    {
        $shippingMethod = $this->scopeConfig->getValue('swiftotter/example/shipping_method');
        $paymentMethod = $this->scopeConfig->getValue('swiftotter/example/payment_method');

        $details = <<<OUTPUT
Chapter1_ConfigLoadOrder > config.xml = swiftotter/example/shipping_method = usps<br/>
Chapter1_ConfigLoadOrder2 > frontend > config.xml = swiftotter/example/shipping_method = fedex<br/>
<small>Note that second is loaded before first.</small>
<h3>Results:</h3>
OUTPUT;

        $conclusion = <<<OUTPUT
<br/><br/>
<h3>Conclusion:</h3>
Later modules override earlier modules regardless of their area (former module was more specific in config.xml area).
OUTPUT;


        /** @var Raw $output */
        $output = $this->rawFactory->create();
        $output->setContents($details . implode("<br/>", [
            'Shipping method: ' . $shippingMethod,
            'Payment method: ' . $paymentMethod
        ]) . $conclusion);

        return $output;
    }
}