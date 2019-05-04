<?php

namespace Iz\CustomConfiguration\Controller\Data;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var Iz\CustomConfiguration\Model\Config\Data
     */
    private $whConfig;

    /**
     * Index constructor.
     * @param Context $context
     * @param Iz\CustomConfiguration\Model\Config\Data $whConfig
     */
    public function __construct(
        Context $context,
        \Iz\CustomConfiguration\Model\Config\Data $whConfig
    ) {
        $this->whConfig = $whConfig;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return void
     */
    public function execute()
    {
        var_dump($this->whConfig->get('warehouses'));
        die;
    }
}
