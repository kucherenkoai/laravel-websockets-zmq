<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Interfaces\Collections\TopicCollectionInterface;
use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;

interface CollectionFactoryInterface
{
    public function createUserCollection(): UserCollectionInterface;

    public function createTopicCollection(): TopicCollectionInterface;
}
