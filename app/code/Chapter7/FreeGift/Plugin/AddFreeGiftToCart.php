<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/25
 * @website https://swiftotter.com
 **/

namespace Chapter7\FreeGift\Plugin;

use Magento\Directory\Block\Data;
use Magento\Framework\DataObject;

class AddFreeGiftToCart
{
    private $productRepository;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function afterAddProduct(
        \Magento\Quote\Model\Quote $quote,
        $result,
        \Magento\Catalog\Model\Product $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        if (isset($request['free_product'])) {
            return $result;
        }

        $freeProduct = $quote->addProduct(
            $this->productRepository->get('24-MG04'),
            new DataObject(['free_product' => true, 'qty' => 1])
        );
        $freeProduct->addOption(['is_free' => true]);
        $freeProduct->setCustomPrice(0);
        $freeProduct->setOriginalCustomPrice(0);

        return $result;
    }
}