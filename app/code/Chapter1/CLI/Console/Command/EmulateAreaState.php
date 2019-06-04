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
use Magento\Store\Model\App\Emulation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmulateAreaState extends Command
{
    /** @var State */
    private $state;

    /** @var ManagerInterface */
    private $eventManager;

    /** @var Emulation */
    private $emulation;

    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\App\Emulation $emulation,
        ?string $name = null)
    {
        $this->state = $state;
        $this->eventManager = $eventManager;
        $this->emulation = $emulation;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('trigger:event:area')
            ->setDescription('Triggers a sample event in the admin area and frontend area');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Setting area code to be frontend.');
        $this->state->setAreaCode('frontend');
        $output->writeln('Current area: ' . $this->state->getAreaCode());

        $output->writeln('Triggering "sample_event"');
        $this->eventManager->dispatch('sample_event');

        $output->writeln("\n---\n");

        $this->state->emulateAreaCode('adminhtml', function() use ($output) {
            $output->writeln('Current area: ' . $this->state->getAreaCode());

            $output->writeln('Triggering "sample_event"');
            $this->eventManager->dispatch('sample_event');
            $output->writeln('/\ notice that the frontend event still was triggered.');
        });

        $this->emulation->startEnvironmentEmulation(0, 'adminhtml', true);

        $output->writeln('Current area: ' . $this->state->getAreaCode());

        $output->writeln('Triggering "sample_event"');
        $this->eventManager->dispatch('sample_event');
        $output->writeln('/\ notice that the frontend event still was triggered.');

        $this->emulation->stopEnvironmentEmulation();
    }
}