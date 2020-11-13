<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use WebSocketsZMQ\ZMQContexts\ZMQPullContext;
use WebSocketsZMQ\ZMQContexts\ZMQPushContext;

interface ConfigFactoryInterface
{
    public function createConfig(): ConfigInterface;

    public function createZMQPullContext(ConfigInterface $config): ZMQPullContext;

    public function createZMQPushContext(ConfigInterface $config): ZMQPushContext;

}
