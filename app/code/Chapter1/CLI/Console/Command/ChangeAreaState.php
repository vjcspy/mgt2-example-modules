<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CLI\Console\Command;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Framework\Event\ManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChangeAreaState extends Command
{
    /** @var State */
    private $state;

    /** @var ManagerInterface */
    private $eventManager;

    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        ?string $name = null)
    {
        $this->state = $state;
        $this->eventManager = $eventManager;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('trigger:event')
            ->setDescription('Triggers a sample event');

        parent::configure();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln('Current area: ' . $this->state->getAreaCode());
            $output->writeln('Triggering "sample_event"');
            $this->eventManager->dispatch('sample_event');
        } catch (\Exception $ex) {
            $output->writeln('Here\'s what happens when you call getAreaCode with no area code:');
            $output->writeln('Exception: ' . $ex->getMessage());
        }

        $output->writeln("\n-------\n");

        $this->state->setAreaCode('frontend');
        $output->writeln('Current area: ' . $this->state->getAreaCode());

        $output->writeln('Triggering "sample_event"');
        $this->eventManager->dispatch('sample_event');
    }
}