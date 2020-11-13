<?php

namespace WebSocketsZMQ\Requests;

use WebSocketsZMQ\Interfaces\Request\RequestMessageInterface;
use WebSocketsZMQ\Interfaces\Request\RequestParamsInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;

class RequestParams implements RequestParamsInterface {

    private RequestMessageInterface $requestMessage;
    private TopicInterface $topic;

    public function __construct(TopicInterface $topic, RequestMessageInterface $requestMessage)
    {
        $this->topic = $topic;
        $this->requestMessage = $requestMessage;
    }

    public function getCode(): int
    {
        return $this->requestMessage->getCode();
    }

    public function getTopic(): TopicInterface
    {
        return $this->topic;
    }

    public function getBody()
    {
        return $this->requestMessage->getBody();
    }

    public function getRequestMessage(): RequestMessageInterface
    {
        return $this->requestMessage;
    }

}
