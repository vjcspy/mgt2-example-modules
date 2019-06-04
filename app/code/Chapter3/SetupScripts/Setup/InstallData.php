<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\SetupScripts\Setup;

use Chapter3\SetupScripts\Tables;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->insert(
            Tables::PRODUCT_DISCOUNTS,
            [
                'product_id' => 1,
                'name' => 'First product discount',
                'amount' => 2
            ]
        );

        $setup->getConnection()->insert(
            Tables::PRODUCT_DISCOUNTS,
            [
                'product_id' => 2,
                'name' => 'First product discount',
                'amount' => 4
            ]
        );
    }
}