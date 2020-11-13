<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Client\Broadcast;
use WebSocketsZMQ\Interfaces\Entities\ClientRouterInterface;
use WebSocketsZMQ\Interfaces\Entities\ValidatorInterface;

interface ValidatorFactoryInterface
{
    public function createValidator(Broadcast $clientValidator, ClientRouterInterface $clientRouter): ValidatorInterface;
}
