<?php


namespace Iz\ExtensibleModel\Model\ResourceModel;


use Iz\ExtensibleModel\Api\Data\PostInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(PostInterface::TABLE, PostInterface::ID);
    }
}