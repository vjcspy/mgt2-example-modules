<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Challenge12PluginDebug\Controller\Index;

use Chapter1\Proxies\Model\MyModel;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;

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

        $result = $this->myModel->get('Joseph');

        $details = <<<OUTPUT
<h2>Output:</h2>
<p>Result: <pre>{$result}</pre></p>
<p>Expected: <pre><i><b>Elissa</b></i></pre></p>
OUTPUT;

        $output->setContents($details);

        return $output;
    }
}