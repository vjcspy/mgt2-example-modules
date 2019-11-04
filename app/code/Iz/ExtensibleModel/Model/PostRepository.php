<?php


namespace Iz\ExtensibleModel\Model;


use Iz\ExtensibleModel\Api\Data\PostInterface;
use Iz\ExtensibleModel\Api\Data\PostSearchResultsInterface;
use Iz\ExtensibleModel\Api\PostRepositoryInterface;
use Iz\ExtensibleModel\Model\ResourceModel\Post\Collection;
use Iz\ExtensibleModel\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class PostRepository implements PostRepositoryInterface
{

    /**
     * @var PostFactory
     */
    private $postFactory;
    /**
     * @var CollectionFactory
     */
    private $postCollectionFactory;
    /**
     * @var PostSearchResultsInterfaceFactory
     */
    private $entitySearchResultsInterfaceFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var JoinProcessorInterface
     */
    private $extensionAttributesJoinProcessor;

    public function __construct(
        \Iz\ExtensibleModel\Model\PostFactory $postFactory,
        \Iz\ExtensibleModel\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        \Iz\ExtensibleModel\Api\Data\PostSearchResultsInterfaceFactory $postSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    )
    {
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->entitySearchResultsInterfaceFactory = $postSearchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save(\Iz\ExtensibleModel\Api\Data\PostInterface $post)
    {
        try {
            /** @var \Iz\ExtensibleModel\Model\ResourceModel\Post $resource */
            $resource = $post->getResource();

            //Co 1 diem truoc day minh nham do la khong can phai ep kieu entity ve interface ma magento default lam dieu do cho minh
            $resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function getById($entityId)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var Post $entity */
        $entity = $this->postFactory->create()->load($value, $attributeCode);
        if (!$entity->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function delete(\Iz\ExtensibleModel\Api\Data\PostInterface $entity)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritdoc
     */
    public function deleteById($entityId)
    {
        $entity = $this->getById($entityId);
        return $this->delete($entity);
    }

    /**
     * @inheritdoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->postCollectionFactory->create();

        // Optional. Neu muon co cai nay thi phai khai bao trong extension_attributes.xml
        $this->extensionAttributesJoinProcessor->process($collection, PostInterface::class);

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var PostSearchResultsInterface $searchResults */
        $searchResults = $this->entitySearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}