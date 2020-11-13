<?php

namespace WebSocketsZMQ\Interfaces\Collections;

use WebSocketsZMQ\Interfaces\Entities\UserInterface;

interface UserCollectionInterface extends CollectionInterface
{
    public function attach(UserInterface $user): UserInterface;

    public function detach(UserInterface $user): UserInterface;
}
