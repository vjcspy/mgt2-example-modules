<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Queueing\BasicMessageQueue\Operations;

use Magento\AsynchronousOperations\Api\Data\OperationInterfaceFactory;
use Magento\Framework\MessageQueue\PublisherInterface;

class Scheduler
{
    /** @var PublisherInterface */
    private $publisher;

    /** @var OperationInterfaceFactory */
    private $operationFactory;

    public function __construct(
        PublisherInterface $publisher,
        OperationInterfaceFactory $operationFactory
    ) {
        $this->publisher = $publisher;
        $this->operationFactory = $operationFactory;
    }

    /**
     * @param array $operationData
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    public function execute($operationData)
    {
        $operation = $this->operationFactory->create();
        $operation->setSerializedData(json_encode($operationData));

        $this->publisher->publish('chapter8.queue', $operation);
    }
}