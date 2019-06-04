<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Api;

use Chapter3\Database\Api\Data\DiscountInterface;
use Chapter3\Database\Api\Data\DiscountSearchResultsInterface;

interface DiscountRepositoryInterface
{
    /**
     * @param \Chapter3\Database\Api\Data\DiscountInterface $discount
     * @return \Chapter3\Database\Api\Data\DiscountInterface
     */
    public function save(Data\DiscountInterface $discount): DiscountInterface;

    /**
     * @param int $id
     * @return \Chapter3\Database\Api\Data\DiscountInterface
     */
    public function getById($id): DiscountInterface;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Chapter3\Database\Api\Data\DiscountSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria);

    /**
     * @param \Chapter3\Database\Api\Data\DiscountInterface $discount
     * @return bool
     */
    public function delete(Data\DiscountInterface $discount): bool;

    /**
     * @param $discountId
     * @return bool
     */
    public function deleteById($discountId): bool;
}