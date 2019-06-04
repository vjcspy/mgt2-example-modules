<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/21
 * @website https://swiftotter.com
 **/

namespace Chapter2\UiDemonstration\Ui\Component\Grid\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class PostActions extends Column
{
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components,
        array $data
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['row_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl('chapter21uidemonstration/index/edit', [ 'id' => $item['row_id']]),
                        'label' => __('Edit'),
                        'target' => '_blank'
                    ];
                }
            }
        }

        return $dataSource;
    }
}