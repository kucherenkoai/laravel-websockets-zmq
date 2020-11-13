<?php

namespace WebSocketsZMQ\Collections;

use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;

class UserCollection extends Collection implements UserCollectionInterface {

    public function attach(UserInterface $user): UserInterface
    {
        $this->data[$user->getId()] = $user;
        return $user;
    }

    public function detach(UserInterface $user): UserInterface
    {
        if(!isset($this->data[$user->getId()])){
            return $user;
        }
        unset($this->data[$user->getId()]);

        return $user;
    }
}


