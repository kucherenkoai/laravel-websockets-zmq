<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Facades\StorageFacade;
use WebSocketsZMQ\Interfaces\Factories\FacadeFactoryInterface;
use WebSocketsZMQ\Interfaces\Storages\TopicStorageInterface;
use WebSocketsZMQ\Interfaces\Storages\UserStorageInterface;
use WebSocketsZMQ\Logs\PusherLogs;

class FacadeFactory implements FacadeFactoryInterface
{
    public function createStorageFacade(UserStorageInterface $userStorage, TopicStorageInterface $topicStorage): StorageFacade
    {
        return new StorageFacade($userStorage, $topicStorage);
    }

    public function createDefaultStorageFacade(): StorageFacade
    {
        //Create Factories
        $storageFactory    = new StorageFactory();
        $collectionFactory = new CollectionFactory();
        $entityFactory     = new EntityFactory();
        $clientFactory     = new ClientFactory();
        $logs              = new PusherLogs();

        //Create and add topics and attach to topic collection
        $broadcast      = $clientFactory->createBroadcast();
        $topicCollection = $collectionFactory->createTopicCollection();

        //Attach to collection
        foreach ($broadcast->topics() as $topicName) {
            $topicCollection->attach($entityFactory->createTopic($topicName,$collectionFactory->createUserCollection()));
        }

        $topics = $topicCollection->getAll();

        foreach ($topics as $topic) {
            $logs->topic('Topic created.',$topic,true);
        }

        //Create main Storage facade
        return new StorageFacade(
            $storageFactory->createUserStorage($collectionFactory->createUserCollection()),
            $storageFactory->createTopicStorage($topicCollection,$broadcast)
        );

    }
}
