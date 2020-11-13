<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Collections\TopicCollection;
use WebSocketsZMQ\Collections\UserCollection;
use WebSocketsZMQ\Interfaces\Collections\TopicCollectionInterface;
use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Factories\CollectionFactoryInterface;

class CollectionFactory implements CollectionFactoryInterface
{
    public function createUserCollection(): UserCollectionInterface
    {
        return new UserCollection();
    }

    public function createTopicCollection(): TopicCollectionInterface
    {
        return new TopicCollection();
    }
}
