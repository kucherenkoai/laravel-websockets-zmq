<?php

namespace WebSocketsZMQ\Interfaces\Storages;

use WebSocketsZMQ\Interfaces\Collections\CollectionInterface;

interface StorageInterface
{
    public function getCollection(): CollectionInterface;

}
