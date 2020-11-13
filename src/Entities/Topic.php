<?php

namespace WebSocketsZMQ\Entities;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;

class Topic implements TopicInterface {

    private $name;

    private UserCollectionInterface $userCollection;

    public function __construct($name, UserCollectionInterface $userCollection)
    {
        $this->name = $name;
        $this->userCollection = $userCollection;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUserCollection(): UserCollectionInterface
    {
        return $this->userCollection;
    }

}


