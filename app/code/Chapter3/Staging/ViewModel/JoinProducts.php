<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter3\Staging\ViewModel;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Eav\Model\AttributeRepository;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory as OrderItemCollectionFactory;
use Magento\Staging\Model\VersionManager;

class JoinProducts implements ArgumentInterface
{
    /** @var Registry */
    private $registry;

    /** @var OrderItemCollectionFactory */
    private $orderItemCollectionFactory;

    /** @var ProductResource */
    private $productResource;

    /** @var VersionManager */
    private $versionManager;

    /** @var AttributeRepository */
    private $attributeRepository;

    public function __construct(
        Registry $registry,
        OrderItemCollectionFactory $orderItemCollectionFactory,
        ProductResource $productResource,
        VersionManager $versionManager,
        AttributeRepository $attributeRepository
    ) {
        $this->registry = $registry;
        $this->orderItemCollectionFactory = $orderItemCollectionFactory;
        $this->productResource = $productResource;
        $this->versionManager = $versionManager;
        $this->attributeRepository = $attributeRepository;
    }

    public function getOrderItems()
    {
        $nameAttribute = $this->attributeRepository->get(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            ProductAttributeInterface::CODE_NAME
        );

        $collection = $this->orderItemCollectionFactory->create();
        $collection->join(
            ['product' => $this->productResource->getEntityTable()],
            'main_table.product_id = product.' . $this->productResource->getEntityIdField(),
            ['sku', 'created_in', 'updated_in']
        );

        $collection->join(
            ['at_name_attribute' => $nameAttribute->getBackendTable()],
            'product.row_id = at_name_attribute.row_id AND ' .
                $collection->getConnection()->quoteInto('at_name_attribute.attribute_id = ?', $nameAttribute->getAttributeId()),
            ['product_name' => 'value']
        );

        $collection->load(); // easy breakpoint access

        return $collection;
    }

    /**
     * @return ProductInterface
     * @throws NotFoundException
     */
    public function getProduct()
    {
        $product = $this->registry->registry('current_product');

        if (!$product) {
            throw new NotFoundException(__('Product #1 is not found.'));
        }

        return $product;
    }
}