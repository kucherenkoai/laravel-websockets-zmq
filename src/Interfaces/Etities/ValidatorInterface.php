<?php

namespace WebSocketsZMQ\Interfaces\Entities;

use WebSocketsZMQ\Client\Broadcast;
use Ratchet\ConnectionInterface;

interface ValidatorInterface
{
    public function __construct(Broadcast $broadcast, ClientRouterInterface $clientRouter);

    public function broadcastConnect(ConnectionInterface $conn);

    public function broadcastSubscribe(TopicInterface $topic, UserInterface $user): bool;

    public function routeMessageValidate(TopicInterface $topic, UserInterface $user): bool;
}
