<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/01/19
 * @website https://swiftotter.com
 **/

namespace Chapter1\Proxies\Model;

class MyProxiedClass
{
    private $myModel;

    public function __construct(MyModel $myModel)
    {
        $this->myModel = $myModel;
    }

    public function format($name)
    {
        return $this->myModel->format($name);
    }
}