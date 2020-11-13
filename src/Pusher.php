<?php

namespace WebSocketsZMQ;

use WebSocketsZMQ\Factories\ClientFactory;
use WebSocketsZMQ\Factories\ConfigFactory;
use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Entities\RouterInterface;
use WebSocketsZMQ\Interfaces\Facades\StorageFacadeInterface;
use WebSocketsZMQ\Interfaces\Factories\EntityFactoryInterface;
use WebSocketsZMQ\Interfaces\Factories\RequestFactoryInterface;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use WebSocketsZMQ\Factories\RequestFactory;
use WebSocketsZMQ\Factories\EntityFactory;
use WebSocketsZMQ\Factories\FacadeFactory;
use WebSocketsZMQ\Logs\PusherLogs;

class Pusher implements MessageComponentInterface {

    private RouterInterface $router;
    private StorageFacadeInterface $storageFacade;
    private EntityFactoryInterface $entityFactory;
    private RequestFactoryInterface $requestFactory;
    private BroadcastInterface $broadcast;
    private PusherLogs $logs;
    private ConfigInterface $config;

    public function __construct()
    {
        $clientFactory    = new ClientFactory();
        $facadeFactory    = new FacadeFactory();

        $this->entityFactory  = new EntityFactory();
        $this->requestFactory = new RequestFactory();
        $this->broadcast      = (new ClientFactory())->createBroadcast();
        $this->storageFacade  = $facadeFactory->createDefaultStorageFacade();
        $this->logs           = new PusherLogs();
        $this->config         = (new ConfigFactory())->createConfig();

        //Create Router
        $this->router = $clientFactory->createRouter();
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->logs->message('Client send message.',$msg,$from,true);

        $request = $this->requestFactory->createRequest();
        $request->addMessage($this->requestFactory->createRequestMessage($msg));

        //Get user and topic
        $user  = $this->storageFacade->getUserByConnection($from);
        $topic = $this->storageFacade->getTopicByName($request->getMessage()->getTopicName());

        if (!$request->validateRequest() || !$topic || !$user){
            $this->logs->message('Client message not valid.',$msg,$from,false);
            return false;
        }

        $request->addUser($user);
        $request->addTopic($topic);

        //Add use to topic
        if($request->validateAttachTopic() && !$this->config->getUserToAllTopics()){
            $this->storageFacade->addUserToTopic($request->getUser(),$request->getTopic());
            return true;
        }

        //Delete user from topic
        if($request->validateDetachTopic() && !$this->config->getUserToAllTopics()) {
            $this->storageFacade->deleteUserFromTopic($request->getUser(),$request->getTopic());
            return true;
        }

        //Send message from client to application
        if($request->validateForRoute()){
            $this->router->make($request);
            return true;
        }
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->logs->connect('New client connect.',$conn,true);

        if(!$userId = $this->broadcast->broadcastConnect($conn)){
            $conn->close();
            $this->logs->connect('Permission denied for new connection.',$conn,false);
            return false;
        }

        $user = $this->entityFactory->createUser($conn,$userId);
        $this->storageFacade->addUser($user);
        $this->logs->user('New user connected.',$user,true);

        if($this->config->getUserToAllTopics()){
            $this->storageFacade->addUserToAllTopics($user);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $user = $this->storageFacade->getUserByConnection($conn);
        $conn->close();

        if($user){
            $this->storageFacade->deleteUser($user);
            $this->logs->user('User disconnected.',$user,true);
            return false;
        }
        $this->logs->notifications('User tried exit. But user not found.',false);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $user = $this->storageFacade->getUserByConnection($conn);
        $this->storageFacade->deleteUser($user);
        $conn->close();
        $this->logs->user('User exit. Error exception.',$user,false);
    }

    public function onBlogEntry($response)
    {
        $response = json_decode($response);

        $topic = $this->storageFacade->getTopicByName($response->topicName);

        $responseUsers = $response->users;
        $topicUsers    = $topic->getUserCollection()->getAll();

        foreach ($topicUsers as $topicUser) {
            if(in_array($topicUser->getId(),$responseUsers)){
                $topicUser->getConnection()->send(json_encode([4,$topic->getName(),$response->data]));
                $this->logs->response('Data send to user.',$topicUser,$topic,json_encode($response->data),true);
            }
        }
    }

}
