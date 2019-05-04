<?php

namespace Iz\CustomAdminGrid\Controller\Adminhtml\Grid;

use Iz\CustomAdminGrid\Controller\Adminhtml\Grid;

class Add extends Grid
{
    /**
     * Forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
