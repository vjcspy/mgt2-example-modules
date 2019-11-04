<?php
/**
 * @author Interactiv4 Team
 * @copyright  Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Api\Data;

/**
 * Interface PostSearchResultsInterface
 */
interface CustomPostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface[]
     */
    public function getItems();

    /**
     * @param \Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
