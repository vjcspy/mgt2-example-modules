<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Queueing\BasicMessageQueue\Operations;

use Magento\Framework\Bulk\BulkManagementInterface;
use Magento\AsynchronousOperations\Api\Data\OperationInterface;
use Magento\AsynchronousOperations\Api\Data\OperationInterfaceFactory;
use Magento\Framework\DB\Adapter\ConnectionException;
use Magento\Framework\DB\Adapter\DeadlockException;
use Magento\Framework\DB\Adapter\LockWaitException;
use Magento\Framework\Exception\TemporaryStateExceptionInterface;

class Consumer
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    /**
     * Consumer constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Processing operation for update price
     *
     * @param \Magento\AsynchronousOperations\Api\Data\OperationInterface $operation
     * @return void
     */
    public function processOperation(\Magento\AsynchronousOperations\Api\Data\OperationInterface $operation)
    {
        $serializedData = $operation->getSerializedData();
        $unserializedData = json_decode($serializedData, true);

        echo "Received data:\n";
        print_r($unserializedData);

        $this->logger->debug('Time: ' . print_r($unserializedData, true));
    }
}