<?php

namespace WebSocketsZMQ\Facades;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Facades\StorageFacadeInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;
use Ratchet\ConnectionInterface;

class StorageFacade implements StorageFacadeInterface {

    private UserStorageInterface $userStorage;
    private TopicStorageInterface $topicStorage;

    public function __construct(UserStorageInterface $userStorage, TopicStorageInterface $topicStorage)
    {
        $this->userStorage  = $userStorage;
        $this->topicStorage  = $topicStorage;
    }

    public function addUser(UserInterface $user): ?UserInterface
    {
        return $this->userStorage->getCollection()->attach($user);
    }

    public function deleteUser(UserInterface $user): bool
    {
        $this->userStorage->getCollection()->detach($user);
        $this->topicStorage->deleteUser($user);
        return true;
    }

    public function getUserByConnection(ConnectionInterface $conn): ?UserInterface
    {
        return $this->userStorage->getUserByConnection($conn);
    }

    public function addUserToTopic(UserInterface $user, TopicInterface $topic): ?UserInterface
    {
        return $this->topicStorage->addUserToTopic($topic,$user);
    }
    public function addUserToAllTopics(UserInterface $user): ?UserInterface
    {
        return $this->topicStorage->addUser($user);
    }

    public function deleteUserFromTopic(UserInterface $user, TopicInterface $topic): UserInterface
    {
        return $this->topicStorage->deleteUserFromTopic($topic,$user);
    }

    public function getTopicByName($name): ?TopicInterface
    {
        return $this->topicStorage->getTopicByName($name);
    }


}


