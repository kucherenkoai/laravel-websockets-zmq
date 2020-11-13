<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use Ratchet\ConnectionInterface;

interface EntityFactoryInterface
{
    public function createUser(ConnectionInterface $connection, $userId): UserInterface;

    public function createTopic($name, UserCollectionInterface $userCollection): TopicInterface;
}
