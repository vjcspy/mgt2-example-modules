<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DiscountSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Chapter3\Database\Api\Data\DiscountInterface[]
     */
    public function getItems();

    /**
     * @param \Chapter3\Database\Api\Data\DiscountInterface[] $items
     * @return \Chapter3\Database\Api\Data\DiscountSearchResultsInterface
     */
    public function setItems(array $items);
}