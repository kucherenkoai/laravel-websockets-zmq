<?php

namespace WebSocketsZMQ\Interfaces\Storages;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;

interface TopicStorageInterface extends StorageInterface
{

    public function getTopicByName($topicName): ?TopicInterface;

    public function addUser(UserInterface $user): UserInterface;

    public function deleteUser(UserInterface $user): UserInterface;

}
