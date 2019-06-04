<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Setup;

use Chapter3\Database\Tables;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->insert(Tables::DISCOUNT, [
            'name' => '$10 off',
            'amount' => 10
        ]);

        $setup->getConnection()->insert(Tables::DISCOUNT, [
            'name' => '$20 off',
            'amount' => 20
        ]);

        $setup->getConnection()->insert(Tables::DISCOUNT, [
            'name' => '$30 off',
            'amount' => 30
        ]);
    }
}