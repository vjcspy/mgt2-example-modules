<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/24
 * @website https://swiftotter.com
 **/

namespace Chapter2\UiDemonstration\Plugin;

use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Eav\Api\Data\AttributeInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddProductDetailsToDataProvider
{
    /** @var AttributeRepositoryInterface */
    private $attributeRepository;

    /** @var array */
    private $attributeCache = [];

    const ATTRIBUTES_TO_LOAD = [
        'name',
        'price',
        'description'
    ];

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function afterGetSearchResult(
        \Chapter2\UiDemonstration\Model\DataProvider $subject,
        SearchResult $result
    ) {
        if ($result->isLoaded()) {
            return $result;
        }

        foreach (self::ATTRIBUTES_TO_LOAD as $attributeCode) {
            $this->join($result, $attributeCode);
        }

        return $result;
    }

    private function join(SearchResult $result, string $attributeCode)
    {
        $attribute = $this->getAttribute($attributeCode);
        $alias = 'at_' . $attributeCode;

        $result->getSelect()->joinLeft(
            [$alias => $attribute->getBackendTable()],
            "{$alias}.row_id = main_table.row_id AND {$alias}.attribute_id = {$attribute->getAttributeId()}",
            [$attributeCode => "{$alias}.value"]
        );
    }

    /**
     * @param $name
     * @return AttributeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getAttribute($name)
    {
        if (!isset($this->attributeCache[$name])) {
            $this->attributeCache[$name] = $this->attributeRepository->get('catalog_product', $name);
        }

        return $this->attributeCache[$name];
    }
}