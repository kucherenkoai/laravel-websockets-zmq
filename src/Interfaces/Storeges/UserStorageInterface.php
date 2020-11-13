<?php

namespace WebSocketsZMQ\Interfaces\Storages;

use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use Ratchet\ConnectionInterface;

interface UserStorageInterface extends StorageInterface
{
    public function getUserById($userId): UserInterface;

    public function getUserByConnection(ConnectionInterface $userId): ?UserInterface;

}
