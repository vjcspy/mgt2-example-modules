<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Queueing\BulkSave\Operations;

class BulkDiscountMerger implements \Magento\Framework\MessageQueue\MergerInterface
{
    /**
     * @param array $messageList
     * @return array
     */
    public function merge(array $messages)
    {
        return $messages;
    }
}
