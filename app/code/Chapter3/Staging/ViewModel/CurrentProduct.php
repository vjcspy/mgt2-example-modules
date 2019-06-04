<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter3\Staging\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CurrentProduct implements ArgumentInterface
{
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
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