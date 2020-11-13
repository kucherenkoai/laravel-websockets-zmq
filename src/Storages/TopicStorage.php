<?php

namespace WebSocketsZMQ\Storages;

use WebSocketsZMQ\Interfaces\Collections\TopicCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Logs\PusherLogs;

class TopicStorage extends Storage implements TopicStorageInterface {

    private PusherLogs $logs;
    private BroadcastInterface $broadcast;

    public function __construct(TopicCollectionInterface $collection, BroadcastInterface $broadcast)
    {
        $this->collection = $collection;
        $this->logs       = new PusherLogs();
        $this->broadcast  = $broadcast;
    }

    public function getTopicByName($topicName): ?TopicInterface
    {
        $collection = $this->collection->getAll();
        return $collection[$topicName] ?? null;
    }

    public function addUser(UserInterface $user): UserInterface
    {
        $collection = $this->collection->getAll();

        foreach ($collection as $topic) {
            if(!$this->broadcast->broadcastSubscribe($topic,$user)){
                return null;
            }

            $topic->getUserCollection()->attach($user);
            $this->logs->topicUser('User connected to topic.',$user,$topic,true);
        }
        return $user;
    }

    public function deleteUser(UserInterface $user): UserInterface
    {
        $collection = $this->collection->getAll();

        foreach ($collection as $topic) {
            $topic->getUserCollection()->detach($user);
            $this->logs->topicUser('User deleted from topic.',$user,$topic,true);
        }
        return $user;
    }

    public function addUserToTopic(TopicInterface $topic, UserInterface $user): ?UserInterface
    {
        if(!$this->broadcast->broadcastSubscribe($topic,$user)){
            return null;
        }

        $this->logs->topicUser('User connected to topic.',$user,$topic,true);
        return $topic->getUserCollection()->attach($user);
    }

    public function deleteUserFromTopic(TopicInterface $topic, UserInterface $user): ?UserInterface
    {
        $this->logs->topicUser('Delete user fro topic',$user,$topic,true);
        return $topic->getUserCollection()->detach($user);
    }


}


