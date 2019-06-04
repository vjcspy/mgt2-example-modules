<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter4\EAV\Setup;

use Chapter4\EAV\Attributes;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Customer\Model\Address;
use Magento\Customer\Model\Customer;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Model\Config as EavConfig;
use Magento\Sales\Model\Order;
use Magento\Sales\Setup\SalesSetup;
use Magento\Sales\Setup\SalesSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    /** @var EavSetupFactory */
    private $eavSetupFactory;

    /** @var EavConfig */
    private $eavConfig;

    /** @var AttributeRepositoryInterface */
    private $attributeRepository;

    /** @var SalesSetupFactory */
    private $salesSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        EavConfig $eavConfig,
        AttributeRepositoryInterface $attributeRepository,
        SalesSetupFactory $salesSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeRepository = $attributeRepository;
        $this->salesSetupFactory = $salesSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2') < 0) {
            $this->updateProductAttribute();
            $this->createCustomerAttribute();
        }

        if (version_compare($context->getVersion(), '3') < 0) {
            $this->createCustomerAddressAttribute();
        }

        if (version_compare($context->getVersion(), '3') < 0) {
            $this->createOrderAttribute();
        }

        if (version_compare($context->getVersion(), '4') < 0) {
            $this->createCategoryAttribute();
        }
    }

    private function updateProductAttribute()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->updateAttribute(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            Attributes::PRODUCT_WIDGET_TYPE,
            [
                'label' => 'Specify widget type',
                'is_visible_in_grid' => true
            ]
        );
    }

    /**
     * Adapted from:
     * https://www.mageplaza.com/magento-2-module-development/magento-2-add-customer-attribute-programmatically.html
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createCustomerAttribute()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        // #1 create attribute
        $eavSetup->addAttribute(
            Customer::ENTITY,
            Attributes::CUSTOMER_PREFERRED_WIDGET_TYPE,
            [
                'group'        => 'General',
                'type'         => 'varchar',
                'label'        => 'Preferred Widget Type',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 1,
                'system'       => 0,
            ]
        );

        $widgetType = $this->eavConfig->getAttribute(
            Customer::ENTITY,
            Attributes::CUSTOMER_PREFERRED_WIDGET_TYPE
        );

        // #2 add to forms
        $widgetType->setData('used_in_forms', ['adminhtml_customer']);

        // #3 save, for some reason, I was having trouble with the resource model in saving.
        $widgetType->save();
    }

    /**
     * Adapted from:
     * https://www.mageplaza.com/magento-2-module-development/magento-2-add-customer-attribute-programmatically.html
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createCustomerAddressAttribute()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        // #1 create attribute
        $eavSetup->addAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            Attributes::CUSTOMER_ADDRESS_HOUSE_COLOR,
            [
                'group'        => 'General',
                'type'         => 'varchar',
                'label'        => 'House Color',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 100,
                'system'       => 0,
            ]
        );

        $houseColor = $this->eavConfig->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            Attributes::CUSTOMER_ADDRESS_HOUSE_COLOR
        );

        // #2 add to forms
        $houseColor->setData('used_in_forms', ['adminhtml_customer_address']);

        // #3 save
        $houseColor->save();
    }

    private function createOrderAttribute()
    {
        /** @var SalesSetup $salesSetup */
        $salesSetup = $this->salesSetupFactory->create();

        $salesSetup->addAttribute(Order::ENTITY, 'is_important', [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'length'=> 255,
            'visible' => false,
            'nullable' => true
        ]);

        $salesSetup->getConnection()->addColumn(
            $salesSetup->getTable('sales_order_grid'),
            'is_important',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'comment' =>'Is Important'
            ]
        );
    }

    /**
     * Adapter from: https://devdocs.magento.com/guides/v2.3/ui_comp_guide/howto/add_category_attribute.html
     */
    private function createCategoryAttribute()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, Attributes::CATEGORY_SHOW_HEADER, [
            'type'     => 'int',
            'label'    => 'Show Header',
            'input'    => 'boolean',
            'source'   => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
            'visible'  => true,
            'default'  => '0',
            'required' => false,
            'global'   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'Display Settings',
        ]);
    }
}