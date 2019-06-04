<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Model;

use Chapter3\Database\Api\DiscountRepositoryInterface;
use Chapter3\Database\Model\Discount;
use Chapter3\Database\Model\DiscountFactory;
use Chapter3\Database\Model\ResourceModel\Discount\Collection;
use Chapter3\Database\Api\Data;
use Chapter3\Database\Model\ResourceModel\Discount as DiscountResource;
use Chapter3\Database\Model\ResourceModel\Discount\CollectionFactory as DiscountCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class DiscountRepository implements DiscountRepositoryInterface
{
    /**
     * @var DiscountResource
     */
    protected $resource;

    /**
     * @var DiscountFactory
     */
    protected $discountFactory;

    /**
     * @var DiscountCollectionFactory
     */
    protected $discountCollectionFactory;

    /**
     * @var Data\DiscountSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        DiscountResource $resource,
        DiscountFactory $discountFactory,
        DiscountCollectionFactory $discountCollectionFactory,
        Data\DiscountSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->discountFactory = $discountFactory;
        $this->discountCollectionFactory = $discountCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param Data\DiscountInterface $discount
     * @return Data\DiscountInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\DiscountInterface $discount): Data\DiscountInterface
    {
        try {
            $this->resource->save($discount);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $discount;
    }

    /**
     * @param int $id
     * @return Data\DiscountInterface
     * @throws NoSuchEntityException
     */
    public function getById($id): Data\DiscountInterface
    {
        $discount = $this->discountFactory->create();
        $this->resource->load($discount, $id);

        if (!$discount->getId()) {
            throw new NoSuchEntityException(__('Discount was not found.', $id));
        }
        return $discount;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return Data\DiscountSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var Collection $collection */
        $collection = $this->discountCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\DiscountSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param Data\DiscountInterface $discount
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\DiscountInterface $discount): bool
    {
        try {
            $this->resource->delete($discount);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @param $discountId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($discountId): bool
    {
        return $this->delete($this->getById($discountId));
    }
}
