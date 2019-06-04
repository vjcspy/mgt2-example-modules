<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter2\Blocks\Block;

use Magento\Framework\View\Element\Template;

class ExampleBlock extends Template
{
    public function getTemplateFile($template = null)
    {
        // Set your breakpoint here:
        return parent::getTemplateFile($template);
    }

    public function getCacheLifetime()
    {
        // Set your breakpoint here:
        return parent::getCacheLifetime();
    }
}