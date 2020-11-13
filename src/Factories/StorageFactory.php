<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Interfaces\Collections\TopicCollectionInterface;
use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Factories\StorageFactoryInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;
use WebSocketsZMQ\Storages\TopicStorage;
use WebSocketsZMQ\Storages\UserStorage;

class StorageFactory implements StorageFactoryInterface
{
    public function createUserStorage(UserCollectionInterface $userCollection): UserStorageInterface
    {
        return new UserStorage($userCollection);
    }

    public function createTopicStorage(TopicCollectionInterface $topicCollection, BroadcastInterface $broadcast): TopicStorageInterface
    {
        return new TopicStorage($topicCollection, $broadcast);
    }
}
