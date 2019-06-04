<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Api\Data;

interface CurrencyInformationInterface
{
    /**
     * @return string
     */
    public function getCurrencyCode();

    /**
     * @param string $code
     * @return \Chapter3\Database\Api\Data\CurrencyInformationInterface
     */
    public function setCurrencyCode(string $code);

    /**
     * @return float
     */
    public function getConversionRate();

    /**
     * @param float $fromBase
     * @return \Chapter3\Database\Api\Data\CurrencyInformationInterface
     */
    public function setConversionRate(float $fromBase);
}