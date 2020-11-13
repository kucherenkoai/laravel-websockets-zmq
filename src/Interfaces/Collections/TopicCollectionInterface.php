<?php

namespace WebSocketsZMQ\Interfaces\Collections;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;

interface TopicCollectionInterface extends CollectionInterface
{
    public function attach(TopicInterface $topic): TopicInterface;

    public function detach(TopicInterface $topic): TopicInterface;
}
