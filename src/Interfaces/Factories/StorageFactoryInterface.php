<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Interfaces\Collections\TopicCollectionInterface;
use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;

interface StorageFactoryInterface
{
    public function createUserStorage(UserCollectionInterface $userCollection): UserStorageInterface;

    public function createTopicStorage(TopicCollectionInterface $topicCollection, BroadcastInterface $broadcast): TopicStorageInterface;
}
