<?php

namespace WebSocketsZMQ\Storages;

use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;
use Ratchet\ConnectionInterface;

class UserStorage extends Storage implements UserStorageInterface {

    public function __construct(UserCollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    public function getUserById($userId): UserInterface
    {
        $userCollection = $this->collection->getAll();
        return $userCollection[$userId];
    }

    public function getUserByConnection(ConnectionInterface $connection): ?UserInterface
    {
        $userCollection = $this->collection->getAll();

        foreach ($userCollection as $user) {
                if($user->getConnection()->resourceId === $connection->resourceId){
                    return $user;
            }
        }
        return null;
    }

}


