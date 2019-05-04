<?php

namespace Iz\CustomAdminGrid\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DataSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \SussexDev\Sample\Api\Data\DataInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param \SussexDev\Sample\Api\Data\DataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
