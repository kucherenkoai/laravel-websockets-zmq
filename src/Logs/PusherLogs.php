<?php

namespace WebSocketsZMQ\Logs;

use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;
use WebSocketsZMQ\Factories\ConfigFactory;
use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Request\RequestInterface;

class PusherLogs {

    private ConfigInterface $config;

    public function __construct()
    {
        $this->config = (new ConfigFactory())->createConfig();
    }

    public function connect(string $text, ConnectionInterface $connection, bool $status): void
    {
        if(!$this->config->getLogs()['connect']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['connect']['error'] && !$status){
            return;
        }

        $this->notify('CONNECT',"{$text} resource_id:{$connection->resourceId}",$status);
    }

    public function notifications(string $text, bool $status): void
    {
        if(!$this->config->getLogs()['notification']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['notification']['error'] && !$status){
            return;
        }

        $this->notify('NOTIFICATION',"{$text}", $status);
    }

    public function user(string $text, UserInterface $user, bool $status): void
    {
        if(!$this->config->getLogs()['user']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['user']['error'] && !$status){
            return;
        }

        $this->notify('USER',"{$text} user_id:{$user->getId()}, resource_id:{$user->getConnection()->resourceId}", $status);
    }

    public function topicUser(string $text, UserInterface $user, TopicInterface $topic ,bool $status): void
    {
        if((!$this->config->getLogs()['user']['success'] || !$this->config->getLogs()['topic']['success']) && $status){
            return;
        }

        if((!$this->config->getLogs()['user']['success'] || !$this->config->getLogs()['topic']['success']) && !$status){
            return;
        }

        $this->notify('USER',"{$text} user_id:{$user->getId()}, resource_id:{$user->getConnection()->resourceId}, topic:{$topic->getName()}", $status);
    }

    public function topic(string $text,TopicInterface $topic ,bool $status): void
    {
        if(!$this->config->getLogs()['topic']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['topic']['error'] && !$status){
            return;
        }

        $this->notify('TOPIC',"{$text} topic:{$topic->getName()}", $status);
    }

    public function message(string $text, string $message, ConnectionInterface $connection,  bool $status): void
    {
        if(!$this->config->getLogs()['message']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['message']['error'] && !$status){
            return;
        }

        $this->notify('MESSAGE',"{$text} resource_id:{$connection->resourceId}, original_params:{$message}", $status);
    }

    public function request(string $text, RequestInterface $request, bool $status): void
    {
        if(!$this->config->getLogs()['request']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['request']['error'] && !$status){
            return;
        }

        $this->notify('REQUEST',"$text code: {$request->getMessage()->getCode()}, user_id:{$request->getUser()->getId()}, resource_id:{$request->getUser()->getConnection()->resourceId}, body:".json_encode($request->getBody()),$status);
    }

    public function response(string $text, UserInterface $user, TopicInterface $topic, string $data, bool $status): void
    {
        if(!$this->config->getLogs()['response']['success'] && $status){
            return;
        }

        if(!$this->config->getLogs()['response']['error'] && !$status){
            return;
        }

        $this->notify('RESPONSE',"$text user_id: {$user->getId()}, topic: {$topic->getName()}, data: $data",$status);
    }

    private function notify(string $type, string $text, bool $status): void
    {
        if($status){
            $this->createLog("SUCCESS|$type: ".$text);
            return;
        }
        $this->createLog("ERROR|$type: ".$text);

    }

    private function createLog(string $string)
    {
        Log::channel('webSocketsZMQ')->info($string);
        echo "\r\n".date('Y-m-d H:i:s')."|$string";
    }

}
