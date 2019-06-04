<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Setup;

use Chapter3\Database\Tables;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // I wrap table creation like this to ensure we don't throw errors in code deployment.
        if (!$setup->getConnection()->isTableExists(Tables::DISCOUNT)) {
            $table = $setup->getConnection()->newTable(Tables::DISCOUNT);
            $table->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Discount Id'
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_VARBINARY,
                    255,
                    [],
                    'Discount name'
                )->addColumn(
                    'amount',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    '12,4',
                    ['nullable' => false],
                    'Discount Amount'
                );

            $setup->getConnection()->createTable($table);
        }
    }
}