<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Queueing\BulkSave\Controller\Index;

use Chapter3\Database\Api\Data\DiscountInterface;
use Chapter3\Database\Model\ResourceModel\Discount\Collection;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Queueing\BulkSave\Operations\BulkDiscountScheduler;
use Chapter3\Database\Model\ResourceModel\Discount\CollectionFactory as DiscountCollectionFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var BulkDiscountScheduler */
    private $scheduler;

    /** @var DiscountCollectionFactory */
    private $discountCollectionFactory;

    public function __construct(
        Context $context,
        BulkDiscountScheduler $scheduler,
        DiscountCollectionFactory $discountCollectionFactory
    ) {
        $this->scheduler = $scheduler;
        $this->discountCollectionFactory = $discountCollectionFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Raw $output */
        $output = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        /** @var Collection $collection */
        $collection = $this->discountCollectionFactory->create();

        $contents = [];

        /** @var DiscountInterface $item */
        foreach ($collection as $item) {
            $oldAmount = $item->getAmount();
            $item->setData('amount', rand(5, 25));
            $contents[] = 'Old amount: $' . $oldAmount . ', new amount: $' . $item->getAmount();
        }

        $this->scheduler->execute($collection->getItems());

        $output->setContents('Scheduled update for:<br/>' . implode('<br/>', $contents));
        return $output;
    }
}