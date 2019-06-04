<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CustomConfig\Model\Config;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    public function convert($source)
    {
        $discounts = $source->getElementsByTagName('discount');
        $discountDetails = [];
        $iterator = 0;

        /** @var \DOMElement $discount */
        foreach ($discounts as $discount) {
            /** @var \DOMText $discountInfo */
            foreach ($discount->childNodes as $discountInfo) {
                if ($discountInfo->nodeName && $discountInfo->nodeName !== "#text") {
                    $discountDetails[$discount->getAttribute('name')][$discountInfo->nodeName] = $discountInfo->textContent;
                }
            }
            $iterator++;
        }

        return ['discounts' => $discountDetails];
    }
}