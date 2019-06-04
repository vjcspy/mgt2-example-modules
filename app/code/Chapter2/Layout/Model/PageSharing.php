<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/03/08
 * @website https://swiftotter.com
 **/

namespace Chapter2\Layout\Model;

use Magento\Framework\Exception\NotFoundException;

class PageSharing
{
    private $page;

    public function setPage(\Magento\Framework\View\Result\Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     * @throws NotFoundException
     */
    public function getPage(): \Magento\Framework\View\Result\Page
    {
        if (!$this->page) {
            throw new NotFoundException(__('Page has not been set yet.'));
        }

        return $this->page;
    }
}