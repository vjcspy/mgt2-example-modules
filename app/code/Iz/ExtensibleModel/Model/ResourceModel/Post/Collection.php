<?php


namespace Iz\ExtensibleModel\Model\ResourceModel\Post;


use Iz\ExtensibleModel\Model\Post;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init(\Iz\ExtensibleModel\Model\Post::class, \Iz\ExtensibleModel\Model\ResourceModel\Post::class);
    }
}