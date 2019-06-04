<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/26
 * @website https://swiftotter.com
 **/

namespace Chapter3\Database\Plugin;

use Chapter3\Api\Data\CurrencyInformationInterface;
use Chapter3\Database\Model\CurrencyInformationFactory;
use Magento\Directory\Api\Data\CountryInformationExtensionInterfaceFactory;

class SetCurrencyInformation
{
    const CURRENCIES = [
        'USD',
        'EUR',
        'GBP',
        'INR',
        'AUD'
    ];

    /** @var CurrencyInformationFactory */
    private $currencyInformationFactory;

    /** @var CountryInformationExtensionInterfaceFactory */
    private $extensionFactory;

    public function __construct(
        CurrencyInformationFactory $currencyInformationFactory,
        CountryInformationExtensionInterfaceFactory $extensionFactory
    ) {
        $this->currencyInformationFactory = $currencyInformationFactory;
        $this->extensionFactory = $extensionFactory;
    }

    public function afterGetCountriesInfo(\Magento\Directory\Model\CountryInformationAcquirer $subject, $results)
    {
        /** @var \Magento\Directory\Api\Data\CountryInformationInterface $result */
        foreach ($results as $result) {
            $this->addToItem($result);
        }

        return $results;
    }

    private function addToItem(\Magento\Directory\Api\Data\CountryInformationInterface $result)
    {
        if (!$result->getExtensionAttributes()) {
            $result->setExtensionAttributes($this->extensionFactory->create());
        }

        if ($result->getExtensionAttributes()->getCurrencyInformation()) {
            return;
        }

        /** @var CurrencyInformationInterface $currencyInformation */
        $currencyInformation = $this->currencyInformationFactory->create();
        $currencyInformation->setConversionRate(rand(1000, 1999) / 1000);
        $key = array_rand(self::CURRENCIES);
        $currencyInformation->setCurrencyCode(self::CURRENCIES[$key]);

        $result->getExtensionAttributes()->setCurrencyInformation($currencyInformation);
    }
}