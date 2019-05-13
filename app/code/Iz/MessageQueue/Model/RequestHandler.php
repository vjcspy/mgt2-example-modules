<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Iz\MessageQueue\Model;

class RequestHandler
{
    /**
     * @param string $simpleDataItem
     * @return string
     */
    public function process($simpleDataItem)
    {
        $myfile = fopen("test_queue.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $simpleDataItem);
        fclose($myfile);
        return $simpleDataItem . ' processed by RPC handler';
    }
}
