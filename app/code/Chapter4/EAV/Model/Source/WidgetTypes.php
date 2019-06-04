<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter4\EAV\Model\Source;

class WidgetTypes extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        // this list is often loaded from the database.
        return [
            ['value' => 'light_saber', 'label' => __('Light Saber')],
            ['value' => 'chopter', 'label' => __('Chopter')],
            ['value' => 'glowpanel', 'label' => __('Glowpanel')],
            ['value' => 'holojournal', 'label' => __('Holojournal')],
            ['value' => 'automixer', 'label' => __('Automixer')]
        ];
    }
}