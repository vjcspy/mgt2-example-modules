<?php


namespace Iz\Core\Command;


use Magento\User\Model\UserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ResetALlAdminPassword extends Command
{

    /**
     * @var UserFactory
     */
    private $userFactory;
    /**
     * @var \Magento\User\Model\ResourceModel\User\Collection
     */
    private $userCollection;
    /**
     * @var \Magento\User\Model\ResourceModel\User
     */
    private $userResource;

    public function __construct(
        UserFactory $userFactory,
        \Magento\User\Model\ResourceModel\User $userResource,
        \Magento\User\Model\ResourceModel\User\Collection $userCollection,
        $name = null)
    {
        $this->userResource = $userResource;
        $this->userFactory = $userFactory;
        $this->userCollection = $userCollection;
        parent::__construct($name);
    }

    const PASSWORD_OPTION = "password";


    protected function configure()
    {
        $this
            ->setName('iz:admin:user:reset-all-password')
            ->setDefinition([
                new InputOption(
                    self::PASSWORD_OPTION,
                    '-p',
                    InputOption::VALUE_OPTIONAL,
                    'Password',
                    false
                )
            ])
            ->setDescription('Reset the password of all admin user.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->userCollection as $userData) {
            $user = $this->userFactory->create()->loadByUsername($userData->getData('username'));

            // Password
            if (($password = $input->getOption('password')) === false) {
                $password = "admin123";
            }

            try {
                // @see \Magento\Framework\Session\SessionManager::isSessionExists Hack to prevent session problems
                @session_start();

//                $result = $user->validate();
//                if (is_array($result)) {
//                    throw new \Exception(implode(PHP_EOL, $result));
//                }
                $user->setPassword($password);
                $user->setForceNewPassword(true);
                $this->userResource->save($user);
                $this->userResource->trackPassword($user, $user->getPassword());
                $output->writeln("<info>Password successfully changed for user: {$userData->getData('username')}</info>");
            } catch (\Exception $e) {
                $output->writeln('<error>' . $e->getMessage() . '</error>');
            }
        }
    }
}