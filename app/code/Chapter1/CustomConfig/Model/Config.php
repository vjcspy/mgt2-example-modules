<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\CustomConfig\Model;


class Config
{
    private $configData;

    public function __construct(\Magento\Framework\Config\Data $configData)
    {
        $this->configData = $configData;
    }

    public function get()
    {
        return $this->configData->get();
    }
}