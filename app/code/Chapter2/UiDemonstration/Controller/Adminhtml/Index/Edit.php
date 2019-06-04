<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter2\UiDemonstration\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    /** @var PageFactory */
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $rawFactory
    ) {
        $this->pageFactory = $rawFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}