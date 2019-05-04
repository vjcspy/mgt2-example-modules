<?php
namespace Iz\CustomAdminGrid\Controller\Adminhtml\Grid;

use Iz\CustomAdminGrid\Model\Data;

class MassDelete extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $this->dataRepository->delete($data);
        return $this;
    }
}
