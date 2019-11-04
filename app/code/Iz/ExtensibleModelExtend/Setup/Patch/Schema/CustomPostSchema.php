<?php


namespace Iz\ExtensibleModelExtend\Setup\Patch\Schema;


use Iz\ExtensibleModel\Api\Data\PostInterface;
use Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class CustomPostSchema implements SchemaPatchInterface
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
        return ["custom_post_schema_alias"];
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
            $installer->getTable(CustomPostInterface::SCHEMA_TABLE)
        )->addColumn(
            CustomPostInterface::FIELD_ID,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Custom post Id'
        )->addColumn(
            CustomPostInterface::FIELD_POST_ID,
            Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false],
            'Post Id'
        )->addColumn(
            CustomPostInterface::FIELD_SHORT_DESCRIPTION,
            Table::TYPE_TEXT,
            null,
            ['nullable' => false, 'default' => ''],
            'Short description'
        )->addIndex(
            $installer->getIdxName(
                $installer->getTable(CustomPostInterface::SCHEMA_TABLE),
                [CustomPostInterface::FIELD_POST_ID],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            [CustomPostInterface::FIELD_POST_ID],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addForeignKey(
            $installer->getFkName(
                CustomPostInterface::SCHEMA_TABLE,
                CustomPostInterface::FIELD_POST_ID,
                PostInterface::TABLE,
                PostInterface::ID
            ),
            CustomPostInterface::FIELD_POST_ID,
            $installer->getTable(PostInterface::TABLE),
            PostInterface::ID,
            Table::ACTION_CASCADE
        )->setComment(
            'Custom Post'
        );

        $installer->getConnection()->createTable($table);
        /**
         * Prepare database after install
         */
        $installer->endSetup();

        return $this;
    }
}