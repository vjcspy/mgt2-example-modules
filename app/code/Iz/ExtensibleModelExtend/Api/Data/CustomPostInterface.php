<?php
/**
 * @author Interactiv4 Team
 * @copyright  Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Api\Data;

/**
 * Interface PostInterface
 */
interface CustomPostInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const SCHEMA_TABLE = 'iz_custompost_post';
    const FIELD_ID = 'custom_post_id';
    const FIELD_POST_ID = 'post_id';
    const FIELD_SHORT_DESCRIPTION = 'short_description';

    /**
     * Custom post id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set custom post id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Post id
     *
     * @return int|null
     */
    public function getPostId();

    /**
     * Set post id
     *
     * @param int $postId
     * @return $this
     */
    public function setPostId($postId);

    /**
     * Short description
     *
     * @return string|null
     */
    public function getShortDescription();

    /**
     * Set short description
     *
     * @param string $shortDescription
     * @return $this
     */
    public function setShortDescription($shortDescription);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Iz\ExtensibleModelExtend\Api\Data\CustomPostExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Iz\ExtensibleModelExtend\Api\Data\CustomPostExtensionInterface $extensionAttributes
    );
}
