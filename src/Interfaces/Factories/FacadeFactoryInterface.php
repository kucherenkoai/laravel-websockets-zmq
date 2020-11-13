<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Facades\StorageFacade;
use WebSocketsZMQ\Interfaces\Entities\ValidatorInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;

interface FacadeFactoryInterface
{
    public function createStorageFacade(UserStorageInterface $userStorage, TopicStorageInterface $topicStorage): StorageFacade;

    public function createDefaultStorageFacade(): StorageFacade;
}
