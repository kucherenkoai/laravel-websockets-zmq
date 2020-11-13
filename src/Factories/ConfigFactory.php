<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Config\Config;
use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use WebSocketsZMQ\Interfaces\Factories\ConfigFactoryInterface;
use WebSocketsZMQ\ZMQContexts\ZMQPullContext;
use WebSocketsZMQ\ZMQContexts\ZMQPushContext;

class ConfigFactory  implements ConfigFactoryInterface
{
    public function createConfig(): ConfigInterface
    {
        return new Config();
    }

    public function createZMQPullContext(ConfigInterface $config): ZMQPullContext
    {
        return new ZMQPullContext($config);
    }

    public function createZMQPushContext(ConfigInterface $config): ZMQPushContext
    {
        return new ZMQPushContext($config);
    }
}
