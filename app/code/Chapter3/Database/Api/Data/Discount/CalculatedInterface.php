<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Api\Data\Discount;

interface CalculatedInterface
{
    /**
     * @return float
     */
    public function getTotalCalculated(): float;
}