<?php
namespace Iz\CustomAdminGrid\Model\ResourceModel\Data;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_idFieldName = 'id_column';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init('Iz\CustomAdminGrid\Model\Data', 'Iz\CustomAdminGrid\Model\ResourceModel\Data');
    }
}
