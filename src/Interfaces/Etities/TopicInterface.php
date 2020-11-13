<?php

namespace WebSocketsZMQ\Interfaces\Entities;

use WebSocketsZMQ\Interfaces\Collections\UserCollectionInterface;

interface TopicInterface
{
    public function __construct($name, UserCollectionInterface $userCollection);

    public function getName();

    public function getUserCollection(): UserCollectionInterface;


}
