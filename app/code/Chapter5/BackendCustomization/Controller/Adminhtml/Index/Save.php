<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter5\BackendCustomization\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Backend\App\Action\Context;

class Save extends \Magento\Backend\App\Action
{
    /** @var RedirectFactory */
    private $redirectFactory;

    public function __construct(
        Context $context,
        RedirectFactory $redirectFactory
    ) {
        $this->redirectFactory = $redirectFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $redirect */
        $redirect = $this->redirectFactory->create();
        $redirect->setPath('chapter5backendcustomization/index/index');

        return $redirect;
    }
}