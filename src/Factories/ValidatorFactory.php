<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Client\Broadcast;
use WebSocketsZMQ\Interfaces\Entities\ClientRouterInterface;
use WebSocketsZMQ\Interfaces\Entities\ValidatorInterface;
use WebSocketsZMQ\Interfaces\Factories\ValidatorFactoryInterface;
use WebSocketsZMQ\Entities\Validator;

class ValidatorFactory  implements ValidatorFactoryInterface
{
    public function createValidator(Broadcast $broadcast, ClientRouterInterface $clientRouter): ValidatorInterface
    {
        return new Validator($broadcast,$clientRouter);
    }
}
