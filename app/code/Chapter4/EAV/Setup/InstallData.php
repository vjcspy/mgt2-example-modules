<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter4\EAV\Setup;

use Chapter4\EAV\Attributes;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Adapted from: https://devdocs.magento.com/videos/fundamentals/add-new-product-attribute/
 *
 * Class InstallData
 * @package Chapter4\EAV\Setup
 */
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        // \/ drop a breakpoint here \/ to observe the attribute creation process.
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            Attributes::PRODUCT_WIDGET_TYPE,
            [
                'group' => 'General', // note that this automatically creates an attribute group.
                'type' => 'varchar',
                'label' => 'Widget type',
                'input' => 'select',
                'source' => \Chapter4\EAV\Model\Source\WidgetTypes::class,
                'frontend' => \Chapter4\EAV\Model\Frontend\WidgetTypes::class,
                'backend' => \Chapter4\EAV\Model\Backend\WidgetTypes::class,
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
    }
}