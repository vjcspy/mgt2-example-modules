<?php


namespace Iz\CustomConfiguration\Model\Config;


use Magento\Framework\Config\ConverterInterface;

class Converter implements ConverterInterface
{

    /**
     * Convert config
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $warehouses = $source->getElementsByTagName('warehouses_list');
        $warehouseInfo = [];
        $iterator = 0;
        foreach ($warehouses as $warehouse) {
            if (!empty($warehouse->getElementsByTagName("name")[0])) {
                $name = $warehouse->getElementsByTagName("name")[0]->textContent;
            }
            if (!empty($warehouse->getElementsByTagName("postcode")[0])) {
                $postCode = $warehouse->getElementsByTagName("postcode")[0]->textContent;
            }
            if (isset($name) && isset($postCode)) {
                $warehouseInfo[$iterator][$name] = $postCode;
            }
            $iterator++;
        }
        return ['warehouses' => $warehouseInfo];
    }
}
