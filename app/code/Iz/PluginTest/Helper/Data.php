<?php


namespace Iz\PluginTest\Helper;


class Data
{

    /**
     * @var Log
     */
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function run($data)
    {
        $this->log->write("run A");
    }
}
