<?php

namespace WebSocketsZMQ\Collections;

use WebSocketsZMQ\Interfaces\Collections\CollectionInterface;

class Collection implements CollectionInterface {

    protected array $data = [];

    public function getAll(): array
    {
        return $this->data;
    }


}


