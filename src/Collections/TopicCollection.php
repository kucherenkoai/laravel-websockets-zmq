<?php

namespace WebSocketsZMQ\Collections;

use WebSocketsZMQ\Interfaces\Collections\TopicCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;

class TopicCollection extends Collection implements TopicCollectionInterface {

    public function attach(TopicInterface $topic): TopicInterface
    {
        $this->data[$topic->getName()] = $topic;

        return $topic;
    }

    public function detach(TopicInterface $topic): TopicInterface
    {
        if(!$this->data[$topic->getName()]){
            return $topic;
        }
        unset($this->data[$topic->getName()]);

        return $this->data[$topic->getName()];
    }

}


