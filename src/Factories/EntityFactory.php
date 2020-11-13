<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Entities\Topic;
use WebSocketsZMQ\Entities\User;
use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Factories\EntityFactoryInterface;
use Ratchet\ConnectionInterface;

class EntityFactory implements EntityFactoryInterface
{
    public function createUser(ConnectionInterface $connection, $userId): UserInterface
    {
        return new User($connection,$userId);
    }

    public function createTopic($name, UserCollectionInterface $userCollection): TopicInterface
    {
        return new Topic($name,$userCollection);
    }
}
