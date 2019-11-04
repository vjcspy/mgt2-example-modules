<?php


namespace Iz\ExtensibleModel\Api\Data;


interface PostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Iz\ExtensibleModel\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * @param \Iz\ExtensibleModel\Api\Data\PostInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
