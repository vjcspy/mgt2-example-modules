<?php
/**
 * @author Interactiv4 Team
 * @copyright Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Model\ResourceModel;

use Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 */
class CustomPost extends AbstractDb
{

    /**
     * @inheritdoc
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(CustomPostInterface::SCHEMA_TABLE, CustomPostInterface::FIELD_ID);
    }
}
