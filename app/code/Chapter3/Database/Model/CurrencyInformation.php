<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Model;

use Chapter3\Database\Api\Data\CurrencyInformationInterface;

class CurrencyInformation implements CurrencyInformationInterface
{
    private $code;

    private $rate;

    public function getCurrencyCode()
    {
        return (string)$this->code;
    }

    public function setCurrencyCode(string $code)
    {
        $this->code = $code;
    }

    public function getConversionRate()
    {
        return (float)$this->rate;
    }

    public function setConversionRate(float $fromBase)
    {
        $this->rate = $fromBase;
    }
}