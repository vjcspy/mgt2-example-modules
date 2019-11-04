<?php

namespace Iz\MessageQueue\Console;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PublishMessage
 * @package Iz\MessageQueue\Console
 */
class PublishMessage extends Command
{
    /**
     * @var \Magento\Framework\Controller\Result\Json
     */
    private $resultJsonFactory;
    /**
     * @var Json
     */
    private $jsonHelper;
    /**
     * @var PublisherInterface
     */
    private $publisher;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * PublishMessage constructor.
     * @param JsonFactory $resultJsonFactory
     * @param Json $jsonHelper
     * @param PublisherInterface $publisher
     * @param string|null $name
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        Json $jsonHelper,
        PublisherInterface $publisher, // use for publish message in RabbitMQ
        string $name = null
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->jsonHelper = $jsonHelper;
        $this->publisher = $publisher;
        parent::__construct($name);
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setName('iz:queue');
        $this->setDescription('Publish message queue');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            for ($i = 0; $i < 30; $i++) {
                $publishData = [
                    'date'   => date('m/d/Y h:i:s a', time()),
                    'number' => mt_rand()
                ];
                $this->publisher->publish('cus.queue.topic', $this->jsonHelper->serialize($publishData));
                $result = ['msg' => 'success'];
            }
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage()];
        }

        $output->writeln(json_encode($result, null, 2));
    }
}
