<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2018/06/16
 * @website https://swiftotter.com
 **/

namespace SwiftOtter\Test\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}