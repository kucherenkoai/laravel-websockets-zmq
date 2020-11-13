<?php

namespace WebSocketsZMQ\Interfaces\Facades;

use WebSocketsZMQ\Entities\Broadcast;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;
use Ratchet\ConnectionInterface;

interface StorageFacadeInterface
{
    public function __construct(UserStorageInterface $userStorage, TopicStorageInterface $topicStorage);

    public function addUser(UserInterface $user): ?UserInterface;

    public function deleteUser(UserInterface $user): bool;

    public function getUserByConnection(ConnectionInterface $conn);

    public function addUserToTopic(UserInterface $user, TopicInterface $topic): ?UserInterface;

    public function deleteUserFromTopic(UserInterface $user, TopicInterface $topic): UserInterface;

    public function getTopicByName($name): ?TopicInterface;

    public function addUserToAllTopics(UserInterface $user): ?UserInterface;
}
