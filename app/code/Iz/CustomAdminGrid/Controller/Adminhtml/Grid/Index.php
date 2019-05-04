<?php

namespace Iz\CustomAdminGrid\Controller\Adminhtml\Grid;

use Iz\CustomAdminGrid\Controller\Adminhtml\Grid;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class Index extends Grid
{
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
