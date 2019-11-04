<?php


namespace Iz\ExtensibleModel\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

interface PostInterface extends CustomAttributesDataInterface
{
    const TABLE = 'iz_post_entity';
    const ID = 'id';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    /**
     * Retrieve the name
     *
     * @return string
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Retrieve the description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Iz\ExtensibleModel\Api\Data\PostExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Iz\ExtensibleModel\Api\Data\PostExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Iz\ExtensibleModel\Api\Data\PostExtensionInterface $extensionAttributes);
}