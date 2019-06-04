<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Api\Data;

interface DiscountInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getAmount(): float;
}