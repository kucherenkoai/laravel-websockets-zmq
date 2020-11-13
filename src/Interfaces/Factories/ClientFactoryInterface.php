<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Entities\RouterInterface;

interface ClientFactoryInterface
{
    public function createRouter(): RouterInterface;

    public function createBroadcast(): BroadcastInterface;

}
