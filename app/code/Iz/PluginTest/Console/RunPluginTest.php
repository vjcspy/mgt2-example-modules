<?php

namespace Iz\PluginTest\Console;

use Iz\PluginTest\Helper\Data;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunPluginTest extends Command
{
    /**
     * @var Data
     */
    private $data;

    public function __construct(
        Data $data,
        string $name = null
    )
    {
        $this->data = $data;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('iz:plugin');
        $this->setDescription('Run Plugin test');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->data->run("");
        $output->writeln("done");
    }
}
