<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter3\SetupScripts\Setup;

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class Recurring implements InstallSchemaInterface
{
    /** @var State */
    private $state;

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(
        State $state,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->state = $state;
        $this->scopeConfig = $scopeConfig;
    }

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        try {
            echo "\nArea code: " . $this->state->getAreaCode('frontend');
        } catch (\Exception $ex) {
            echo "\nArea code is not set.";
        }

        $setup->startSetup();

        echo "\n" . __DIR__ . ' recurring SCHEMA was run.\n';
        echo "\nStore URL: " . $this->scopeConfig->getValue('web/secure/base_url');
    }
}
