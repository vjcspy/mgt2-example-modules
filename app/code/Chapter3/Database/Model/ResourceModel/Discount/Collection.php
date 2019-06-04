<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Model\ResourceModel\Discount;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Chapter3\Database\Model\Discount::class,
            \Chapter3\Database\Model\ResourceModel\Discount::class
        );
    }

    public function getAllDiscountsOver10()
    {
        return $this->addFieldToFilter('amount', ['gt' => 10]);
    }
}