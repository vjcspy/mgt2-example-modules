<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Model\ResourceModel;

use Chapter3\Database\Tables;

class Discount extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(Tables::DISCOUNT, 'id');
    }

    /**
     * @return float[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAllAmounts(): array
    {
        $select = $this->getConnection()->select();
        $select->from($this->getMainTable(), 'amount');

        return $this->getConnection()->fetchCol($select);
    }

    /**
     * @param int $id
     * @param float $amount
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function updatePrice(int $id, float $amount)
    {
        $this->getConnection()->update(
            $this->getMainTable(),
            ['amount' => $amount],
            $this->getConnection()->quoteInto('id = ?', $id)
        );
    }
}