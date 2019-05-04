<?php


namespace Iz\CustomAdminGrid\Setup\Patch\Data;


use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class DummyData implements DataPatchInterface, PatchVersionInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
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
        // TODO: Implement getDependencies() method.
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        // TODO: Implement getAliases() method.
        return [];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - than under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
        $data = [
            [
                'data_title' => 'Hello World!',
                'data_description' => 'This is the first description.',
                'is_active' => 1
            ],
            [
                'data_title' => 'Hello Again!',
                'data_description' => 'This is the second description.',
                'is_active' => 1
            ],
            [
                'data_title' => 'Welcome To The Third Title',
                'data_description' => 'Here we have a slightly longer description.',
                'is_active' => 0
            ],
            [
                'data_title' => 'Fourth Coming',
                'data_description' => 'This is the fourth description.',
                'is_active' => 1
            ],
            [
                'data_title' => 'TQBFJOTLD',
                'data_description' => 'The quick brown fox jumped over the lazy dog.',
                'is_active' => 0
            ]
        ];

        $table = $this->moduleDataSetup->getTable("custom_admin_grid");
        $connection = $this->moduleDataSetup->getConnection();

        foreach ($data as $datum) {
            $connection->insert($table, $datum);
        }
        return $this;
    }

    /**
     * This version associate patch with Magento setup version.
     * For example, if Magento current setup version is 2.0.3 and patch version is 2.0.2 than
     * this patch will be added to registry, but will not be applied, because it is already applied
     * by old mechanism of UpgradeData.php script
     *
     *
     * @return string
     * @deprecated since appearance, required for backward compatibility
     */
    public static function getVersion()
    {
        // TODO: Implement getVersion() method.
        return '2.1.3';
    }
}
