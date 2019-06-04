<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Model;

use Chapter3\Database\Api\Data\DiscountInterface;
use Chapter3\Database\Model\ResourceModel\Discount as DiscountResource;

class Discount extends \Magento\Framework\Model\AbstractModel implements DiscountInterface
{
    protected function _construct()
    {
        $this->_init(DiscountResource::class);
    }

    public function getId()
    {
        return (int)parent::getId();
    }

    public function getName(): string
    {
        return (string)$this->getData('name');
    }

    public function getAmount(): float
    {
        return (float)$this->getData('amount');
    }
}