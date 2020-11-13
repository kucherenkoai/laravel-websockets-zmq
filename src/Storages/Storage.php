<?php

namespace WebSocketsZMQ\Storages;

use WebSocketsZMQ\Interfaces\Collections\CollectionInterface;
use WebSocketsZMQ\Interfaces\Storages\StorageInterface;

class Storage implements StorageInterface {

    public CollectionInterface $collection;

    public function getCollection(): CollectionInterface
    {
        return $this->collection;
    }

}


