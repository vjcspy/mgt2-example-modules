<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 * Adapted from: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/message-queues/implement-bulk.html
 **/

namespace Queueing\BulkSave\Operations;

use Chapter3\Database\Api\Data\DiscountInterface;
use Magento\Framework\Bulk\BulkManagementInterface;
use Magento\AsynchronousOperations\Api\Data\OperationInterface;
use Magento\AsynchronousOperations\Api\Data\OperationInterfaceFactory;
use Magento\Framework\DataObject\IdentityGeneratorInterface;
use Magento\Authorization\Model\UserContextInterface;

class BulkDiscountScheduler
{
    /** @var BulkManagementInterface */
    private $bulkManagement;

    /** @var OperationInterfaceFactory */
    private $operationFactory;

    /** @var IdentityGeneratorInterface */
    private $identityService;

    /** @var UserContextInterface */
    private $userContext;

    /**
     * ScheduleBulk constructor.
     *
     * @param BulkManagementInterface $bulkManagement
     * @param OperationInterfaceFactory $operartionFactory
     * @param IdentityGeneratorInterface $identityService
     * @param UserContextInterface $userContextInterface
     */
    public function __construct(
        BulkManagementInterface $bulkManagement,
        OperationInterfaceFactory $operartionFactory,
        IdentityGeneratorInterface $identityService,
        UserContextInterface $userContextInterface
    ) {
        $this->userContext = $userContextInterface;
        $this->bulkManagement = $bulkManagement;
        $this->operationFactory = $operartionFactory;
        $this->identityService = $identityService;
    }

    /**
     * Schedule new bulk operation
     *
     * @param array $operationData
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    public function execute($operationData)
    {
        $operationCount = count($operationData);
        if ($operationCount > 0) {
            $bulkUuid = $this->identityService->generateId();
            $bulkDescription = 'Update discount amounts (randomly)';

            $operations = [];

            /** @var DiscountInterface $operation */
            foreach ($operationData as $operation) {
                $serializedData = [
                    'id' => $operation->getId(),
                    'amount' => $operation->getAmount(),
                    'meta_information' => 'Discount',
                ];
                $data = [
                    'data' => [
                        'bulk_uuid' => $bulkUuid,
                        'topic_name' => 'chapter3.discount',
                        'serialized_data' => json_encode($serializedData),
                        'status' => OperationInterface::STATUS_TYPE_OPEN,
                    ]
                ];

                /** @var OperationInterface $operation */
                $operation = $this->operationFactory->create($data);
                $operations[] = $operation;
            }

            $userId = 2;
            $result = $this->bulkManagement->scheduleBulk($bulkUuid, $operations, $bulkDescription, $userId);

            if (!$result) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while processing the request.')
                );
            }
        }
    }
}