<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter2\Blocks\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        /** @var Page $output */
        $output = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $output;
    }
}