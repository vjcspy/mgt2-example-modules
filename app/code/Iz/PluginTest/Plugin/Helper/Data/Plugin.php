<?php

namespace Iz\PluginTest\Plugin\Helper\Data;

use Iz\PluginTest\Helper\Log;

abstract class Plugin
{
    public $name;
    /**
     * @var Log
     */
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    protected function _log($string)
    {
        $this->log->write($this->name . ": " . $string);
    }

    public function beforeRun($subject, $data)
    {
        $this->_log("before");
        return $data;
    }

    public function afterRun($subject, $result, $data)
    {
        $this->_log("after");
        return $result;
    }

    public function aroundRun($subject, callable $process, ...$args)
    {
        $this->_log("around before");
        $process(...$args);
        $this->_log("around after");
    }
}
