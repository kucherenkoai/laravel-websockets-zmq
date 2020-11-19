<?php

namespace WebSocketsZMQ\Requests;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Request\RequestMessageInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Request\RequestInterface;

class Request implements RequestInterface {

    private UserInterface $user;
    private TopicInterface $topic;
    private RequestMessageInterface $requestMessage;

    public function getRouteName(): string
    {
        if($this->topic){
            return $this->topic->getName();
        }
        return null;

    }
    public function getTopic(): TopicInterface
    {
        return $this->topic;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getBody()
    {
        if(!$this->requestMessage){
            return null;
        }
        return $this->requestMessage->getBody();
    }

    public function getMessage(): RequestMessageInterface
    {
        return $this->requestMessage;
    }

    public function addTopic(TopicInterface $topic): TopicInterface
    {
        return $this->topic = $topic;
    }

    public function addUser(UserInterface $user): UserInterface
    {
        return $this->user = $user;
    }

    public function addMessage(RequestMessageInterface $requestMessage): RequestMessageInterface
    {
        return $this->requestMessage = $requestMessage;
    }

    public function validateRequest(): bool
    {
        if(!$this->requestMessage->validateForRoute() && !$this->requestMessage->validateAttachTopic() && !$this->requestMessage->validateDetachTopic()){
            return false;
        }
        return true;
    }

    public function validateForRoute(): bool
    {
        return $this->requestMessage->validateForRoute();
    }

    public function validateAttachTopic(): bool
    {
        return $this->requestMessage->validateAttachTopic();
    }

    public function validateDetachTopic(): bool
    {
        return $this->requestMessage->validateDetachTopic();
    }



}
