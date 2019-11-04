<?php
/**
 * @author Interactiv4 Team
 * @copyright Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Model\ResourceModel\CustomPost;


use Iz\ExtensibleModelExtend\Model\ResourceModel\CustomPost;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(\Iz\ExtensibleModelExtend\Model\CustomPost::class, CustomPost::class);
    }
}
