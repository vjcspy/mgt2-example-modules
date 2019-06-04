<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CLI\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var RawFactory */
    private $rawFactory;

    /** @var \Magento\Framework\App\State */
    private $state;

    /** @var \Magento\Framework\Event\ManagerInterface */
    private $eventManager;

    /** @var \Magento\Store\Model\App\Emulation */
    private $emulation;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $rawFactory,
        \Magento\Framework\App\State $state,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\App\Emulation $emulation
    ) {
        $this->rawFactory = $rawFactory;
        $this->state = $state;
        $this->eventManager = $eventManager;
        $this->emulation = $emulation;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Raw $output */
        $output = $this->rawFactory->create();

        $this->emulation->startEnvironmentEmulation(0, 'adminhtml', true);
        $this->eventManager->dispatch('sample_event');
        $this->emulation->stopEnvironmentEmulation();

        $details = '';

        $output->setContents($details);

        return $output;
    }
}