<?php


namespace Iz\ExtensibleModel\Setup\Patch\Schema;


use Iz\ExtensibleModel\Api\Data\PostInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class PostSchema implements SchemaPatchInterface
{
    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;

    public function __construct(
        SchemaSetupInterface $schemaSetup
    )
    {
        $this->schemaSetup = $schemaSetup;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return ["post_schema_alias"];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - than under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     * @throws \Zend_Db_Exception
     */
    public function apply()
    {
        $this->schemaSetup->startSetup();
        $installer = $this->schemaSetup;

        $table = $installer->getConnection()->newTable(
            $installer->getTable(PostInterface::TABLE)
        )->addColumn(
            PostInterface::ID,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Id'
        )->addColumn(
            PostInterface::NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Name'
        )->addColumn(
            PostInterface::DESCRIPTION,
            Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Description'
        )->setComment(
            'Custom Entity'
        );
        $installer->getConnection()->createTable($table);
        /**
         * Prepare database after install
         */
        $installer->endSetup();

        return $this;
    }
}