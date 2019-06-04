<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/25
 * @website https://swiftotter.com
 **/

namespace Chapter2\Layout\ViewModel;

use Chapter2\Layout\Model\PageSharing;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\LayoutInterface;

class HandleList implements ArgumentInterface
{
    /** @var LayoutInterface */
    private $layout;

    /** @var Registry */
    private $pageSharing;

    public function __construct(LayoutInterface $layout, PageSharing $pageSharing)
    {
        $this->layout = $layout;
        $this->pageSharing = $pageSharing;
    }

    public function getHandles(): array
    {
        return $this->layout->getUpdate()->getHandles();
    }

    public function getCssClasses(): array
    {
        if (!$this->pageSharing->getPage()) {
            return [];
        }

        $page = $this->pageSharing->getPage();
        return explode(' ', $page->getConfig()->getElementAttribute(
            \Magento\Framework\View\Page\Config::ELEMENT_TYPE_BODY,
            \Magento\Framework\View\Page\Config::BODY_ATTRIBUTE_CLASS
        ));
    }
}