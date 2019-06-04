<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter2\Layout\Controller\Index;

use Chapter2\Layout\Model\PageSharing;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Index extends \Magento\Framework\App\Action\Action
{
    private $pageSharing;

    public function __construct(Context $context, PageSharing $pageSharing)
    {
        $this->pageSharing = $pageSharing;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Page $output */
        $output = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->pageSharing->setPage($output);
        $output->addHandle('my_custom_handle');

        $output->getLayout()->getBlock('handle.material'); // forcing $layout->build();

        if ($this->getRequest()->getParam('xml')) {
            /** @var Raw $raw */
            $raw = $this->resultFactory->create(ResultFactory::TYPE_RAW);
            $raw->setContents(
                '<xmp style="max-width: 75%; overflow-wrap: normal; word-wrap: break-word; white-space: pre-wrap; margin: 0 auto;">' .
                    $output->getLayout()->getXmlString() .
                '</xmp>');
            return $raw;
        }

        return $output;
    }
}