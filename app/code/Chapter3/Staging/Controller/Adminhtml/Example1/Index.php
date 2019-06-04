<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter3\Staging\Controller\Adminhtml\Example1;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;

class Index extends \Magento\Framework\App\Action\Action
{
    private $registry;

    private $productRepository;

    public function __construct(
        Context $context,
        Registry $registry,
        ProductRepositoryInterface $productRepository)
    {
        $this->registry = $registry;
        $this->productRepository = $productRepository;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Page $output */
        $output = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $product = $this->productRepository->getById(1);
        $this->registry->register('current_product', $product);

        return $output;
    }
}