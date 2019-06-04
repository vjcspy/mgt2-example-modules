<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Plugins\Controller\Example2;

use Chapter1\CustomConfig\Model\Config;
use Chapter1\CustomConfig\Model\ConfigFactory;
use Chapter1\Plugins\Model\MyModel;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Module\Dir;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var RawFactory */
    private $rawFactory;

    /** @var MyModel */
    private $myModel;

    public function __construct(
        Context $context,
        RawFactory $rawFactory,
        MyModel $myModel
    ) {
        $this->rawFactory = $rawFactory;
        $this->myModel = $myModel;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Raw $output */
        $output = $this->rawFactory->create();

        $result = $this->myModel->format('Joseph (original)');

        $details = <<<OUTPUT
<h2>Output:</h2>
<p>Result: {$result}</p>
OUTPUT;

        $output->setContents($details);

        return $output;
    }
}