<?php
/**
 * @author Interactiv4 Team
 * @copyright Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Model;

use Iz\ExtensibleModelExtend\Model\ResourceModel\CustomPost as ResourceModelPost;
use Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class Post
 */
class CustomPost extends AbstractExtensibleModel implements CustomPostInterface
{
    /**
     * @inheritdoc
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelPost::class);
    }

    /**
     * @inheritdoc
     */
    public function getPostId()
    {
        return $this->getData(self::FIELD_POST_ID);
    }

    /**
     * @inheritdoc
     */
    public function setPostId($postId)
    {
        return $this->setData(self::FIELD_POST_ID, $postId);
    }

    /**
     * @inheritdoc
     */
    public function getShortDescription()
    {
        return $this->getData(self::FIELD_SHORT_DESCRIPTION);
    }

    /**
     * @inheritdoc
     */
    public function setShortDescription($shortDescription)
    {
        return $this->setData(self::FIELD_SHORT_DESCRIPTION, $shortDescription);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(\Iz\ExtensibleModelExtend\Api\Data\CustomPostExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
