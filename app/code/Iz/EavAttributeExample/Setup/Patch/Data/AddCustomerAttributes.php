<?php

namespace Iz\EavAttributeExample\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomerAttributes implements DataPatchInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;
    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    const CUSTOMER_TELEPHONE_CODE = "customer_telephone";

    /**
     * AddCustomerAttributes constructor.
     * @param CustomerSetupFactory $customerSetupFactory
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
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
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
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

        //Step 1: Add attribute
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->removeAttribute(Customer::ENTITY, AddCustomerAttributes::CUSTOMER_TELEPHONE_CODE);
        $customerSetup->addAttribute(Customer::ENTITY, AddCustomerAttributes::CUSTOMER_TELEPHONE_CODE, [
            'type' => 'varchar',
            'label' => 'Custom Customer Telephone',
            'input' => 'text',
            'required' => false,
            'system' => 0,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'sort_order' => '200'
        ]);

        //Step 2: associate in form, more used_in_forms ['adminhtml_checkout','adminhtml_customer','adminhtml_customer_address','customer_account_edit','customer_address_edit','customer_register_address']
        try {
            $setup = $this->moduleDataSetup;
            $customAttr = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, AddCustomerAttributes::CUSTOMER_TELEPHONE_CODE);
            $setup->getConnection()
                ->insertOnDuplicate(
                    $setup->getTable('customer_form_attribute'),
                    [
                        ['form_code' => 'adminhtml_customer', 'attribute_id' => $customAttr->getId()],
                        ['form_code' => 'customer_account_create', 'attribute_id' => $customAttr->getId()],
                        ['form_code' => 'customer_account_edit', 'attribute_id' => $customAttr->getId()],
                    ]
                );
        } catch (LocalizedException $e) {
        }
    }
}
