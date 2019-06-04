<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\ExtraTesting\Controller\ObjectManager;

use Chapter1\CustomConfig\Model\Config;
use Chapter1\CustomConfig\Model\ConfigFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Module\Dir;

class ExternalClasses extends \Magento\Framework\App\Action\Action
{
    /** @var RawFactory */
    private $rawFactory;

    /** @var \Symfony\Component\CssSelector\CssSelectorConverter */
    private $converter;

    public function __construct(
        Context $context,
        RawFactory $rawFactory,
        \Symfony\Component\CssSelector\CssSelectorConverter $cssSelectorConverter
    ) {
        $this->rawFactory = $rawFactory;
        $this->converter = $cssSelectorConverter;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Raw $output */
        $output = $this->rawFactory->create();

        $details = $this->converter->toXPath('div.item > h4 > a');
        $reflection = new \ReflectionClass($this->converter);
        $property = $reflection->getProperty('translator');

        $property->setAccessible(true);

        /** @var \Symfony\Component\CssSelector\XPath\Translator $value */
        $value = $property->getValue($this->converter);

        try {
            $htmlExtension = $value->getExtension('html');

            if ($htmlExtension) {
                $extension = 'HTML present (GOOD)';
            } else {
                throw new \Exception();
            }
        } catch (\Throwable $ex) {
            $extension = 'No HTML (BAD)';
        }

        $output->setContents($details . '<br/>' . $extension);

        return $output;
    }
}