<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/25
 * @website https://swiftotter.com
 **/

namespace Chapter2\Layout\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Result\Page;

class AddBlock extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        /** @var Page $output */
        $output = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $layout = $output->getLayout();

        $layout->getBlock('product.price.render.default'); // forcing $layout->build();

        $newBlock = $layout->addBlock(Template::class, 'my.block1', 'content');
        $newBlock->setTemplate('Chapter2_Layout::new-block.phtml');

        return $output;
    }
}