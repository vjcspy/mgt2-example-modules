<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CLI\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SampleCommand extends Command
{
    const NAME_ARGUMENT = 'customer_name';

    const EMAIL_OPTION = 'email';

    protected function configure()
    {
        $this->setName('create:customer')
            ->setDescription('Creates a new customer')
            ->setDefinition([
                new InputArgument(
                    self::NAME_ARGUMENT,
                    InputArgument::REQUIRED,
                    'Name'
                ),
                new InputOption(
                    self::EMAIL_OPTION,
                    '-e',
                    InputOption::VALUE_OPTIONAL,
                    'Email'
                ),
            ]);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Welcome, ' . $input->getArgument(self::NAME_ARGUMENT));

        if ($email = $input->getOption(self::EMAIL_OPTION)) {
            $output->write('Your email is: ' . $email);
        }
    }
}