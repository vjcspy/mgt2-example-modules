<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/24
 * @website https://swiftotter.com
 **/

namespace Chapter2\UiDemonstration\Block;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class GenericButton implements ButtonProviderInterface
{
    /** @var \Magento\Framework\UrlInterface */
    protected $urlBuilder;

    /** @var array */
    protected $buttonData;

    /** @var bool */
    protected $hideOnNew;

    public function __construct(
        Context $context,
        $buttonData = [],
        $hideOnNew = false
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->buttonData = $buttonData;
        $this->hideOnNew = $hideOnNew;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function getButtonData()
    {
        return $this->buttonData;
    }
}