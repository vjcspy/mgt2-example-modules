<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\SetupScripts\Setup;

use Chapter3\SetupScripts\Tables;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '2') < 0) {
            $setup->getConnection()->insert(
                Tables::PRODUCT_DISCOUNTS,
                [
                    'product_id' => 99999,
                    'name' => 'Invalid product discount',
                    'amount' => 2
                ]
            );
        }
        $setup->endSetup();
    }
}