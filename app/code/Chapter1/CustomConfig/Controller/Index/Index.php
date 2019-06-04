<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CustomConfig\Controller\Index;

use Chapter1\CustomConfig\Model\Config;
use Chapter1\CustomConfig\Model\ConfigFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Module\Dir;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var RawFactory */
    private $rawFactory;

    /** @var ConfigFactory */
    private $configFactory;

    /** @var \Magento\Framework\Module\Dir\Reader */
    private $moduleReader;

    public function __construct(
        Context $context,
        RawFactory $rawFactory,
        ConfigFactory $configFactory,
        \Magento\Framework\Module\Dir\Reader $moduleReader
    ) {
        $this->rawFactory = $rawFactory;
        $this->configFactory = $configFactory;
        $this->moduleReader = $moduleReader;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Raw $output */
        $output = $this->rawFactory->create();

        /** @var Config $config */
        $config = $this->configFactory->create();

        $configOutput = print_r($config->get(), true);
        $module1 = htmlentities($this->getDiscountContent('Chapter1_CustomConfig'));
        $module2 = htmlentities($this->getDiscountContent('Chapter1_ConfigLoadOrder'));

        $details = <<<OUTPUT
<h2>Chapter1_CustomConfig</h2>
<h4>Defining module</h4>
<pre>${module1}</pre>
<br/>
<h2>Chapter1_ConfigLoadOrder</h2>
<pre>${module2}</pre>
<br/>
<h2>Result</h2>
<pre>${configOutput}</pre>
OUTPUT;

        $output->setContents($details);

        return $output;
    }

    private function getDiscountContent($moduleName)
    {
        $directory = $this->moduleReader->getModuleDir(Dir::MODULE_ETC_DIR, $moduleName);

        if (file_exists($directory . '/discounts.xml')) {
            return file_get_contents($directory . '/discounts.xml');
        } else {
            return '';
        }
    }
}