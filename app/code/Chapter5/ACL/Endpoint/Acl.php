<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/12
 * @website https://swiftotter.com
 **/

namespace Chapter5\ACL\Endpoint;

use Chapter5\ACL\Api\AclInterface;

class Acl implements AclInterface
{
    public function sayHello()
    {
        return "Hello!";
    }
}