<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Entities\RouterInterface;
use WebSocketsZMQ\Interfaces\Factories\ClientFactoryInterface;

class ClientFactory  implements ClientFactoryInterface
{
    public function createRouter(): RouterInterface
    {
        $clientRouter = config('zmqPusher.router');
        return new $clientRouter();
    }

    public function createBroadcast(): BroadcastInterface
    {
        $clientRouter = config('zmqPusher.broadcast');
        return new $clientRouter();
    }
}
