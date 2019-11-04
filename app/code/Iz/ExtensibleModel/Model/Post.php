<?php


namespace Iz\ExtensibleModel\Model;


use Iz\ExtensibleModel\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Post extends AbstractExtensibleModel implements PostInterface, IdentityInterface
{
    const CACHE_TAG = 'iz_post_entity';
    /**
     * @var string
     */
    protected $_cacheTag = 'iz_post_entity';
    /**
     * @var string
     */
    protected $_eventPrefix = 'iz_post_entity';

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(\Iz\ExtensibleModel\Model\ResourceModel\Post::class);
    }

    /**
     * Retrieve the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
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
    public function setExtensionAttributes(\Iz\ExtensibleModel\Api\Data\PostExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}