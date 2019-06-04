<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Queueing\BasicMessageQueue\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Queueing\BasicMessageQueue\Operations\Scheduler as QueueScheduler;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var QueueScheduler */
    private $scheduler;

    public function __construct(
        Context $context,
        QueueScheduler $scheduler
    ) {
        $this->scheduler = $scheduler;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Raw $output */
        $output = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $time = time();

        $this->scheduler->execute([['time' => $time]]);

        $output->setContents('Run <code>bin/magento queue:consumers:start example_consumer</code>. Watch the output for an entry regarding: <pre>Time executed: ' . $time . '</pre>');
        return $output;
    }
}