<?php

namespace WebSocketsZMQ\ZMQContexts;

use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use \ZMQContext;
use \ZMQ;

class ZMQPushContext {

    private ZMQContext $context;
    private $socket;
    private $connection;
    private $connectioHost;

    public function __construct(ConfigInterface $config)
    {
        $this->connectioHost = $config->getContextPushHost();
        $this->context       = $this->createContext();
        $this->socket        = $this->createSocket($this->context);
        $this->connection    = $this->createSocketConnect($this->socket);
    }

    private function createContext()
    {
        return new ZMQContext(1,false);
    }

    private function createSocket(ZMQContext $context)
    {
        return $context->getSocket(ZMQ::SOCKET_PUSH);
    }

    private function createSocketConnect($socket)
    {
        return $socket->connect("tcp://".$this->connectioHost);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
