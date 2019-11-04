<?php
/**
 * @author Interactiv4 Team
 * @copyright  Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Api;

/**
 * Interface PostRepositoryInterface
 */
interface CustomPostRepositoryInterface
{
    /**
     * Save custom post.
     *
     * @param \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface $customPost
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface $customPost);

    /**
     * Retrieve custom post by id.
     *
     * @param int $customPostId
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($customPostId);

    /**
     * Retrieve custom post by attribute.
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode = null);

    /**
     * Delete custom post.
     *
     * @param \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface $customPost
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface $customPost);

    /**
     * Delete custom post by ID.
     *
     * @param $customPostId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($customPostId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);


    /**
     * @param string $shortDescription
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostSearchResultsInterface
     */
    public function getListPostByShortDescription($shortDescription);
}
