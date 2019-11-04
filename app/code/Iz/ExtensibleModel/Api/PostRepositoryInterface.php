<?php


namespace Iz\ExtensibleModel\Api;


use Magento\Framework\Exception\CouldNotSaveException;

interface PostRepositoryInterface
{
    /**
     * Save entity
     *
     * @param \Iz\ExtensibleModel\Api\Data\PostInterface $post
     * @return \Iz\ExtensibleModel\Api\Data\PostInterface
     * @throws CouldNotSaveException
     */
    public function save(\Iz\ExtensibleModel\Api\Data\PostInterface $post);

    /**
     * Retrieve entity by id
     *
     * @param int $entityId
     * @return \Iz\ExtensibleModel\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($entityId);

    /**
     * Retrieve entity by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Iz\ExtensibleModel\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $entity.
     *
     * @param \Iz\ExtensibleModel\Api\Data\PostInterface $entity
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Iz\ExtensibleModel\Api\Data\PostInterface $entity);

    /**
     * Delete entity by ID.
     *
     * @param int $entityId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($entityId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Iz\ExtensibleModel\Api\Data\PostSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}