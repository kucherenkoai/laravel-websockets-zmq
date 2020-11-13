<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Interfaces\Request\RequestInterface;
use WebSocketsZMQ\Interfaces\Request\RequestMessageInterface;
use WebSocketsZMQ\Interfaces\Request\RequestParamsInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Factories\RequestFactoryInterface;
use WebSocketsZMQ\Requests\Request;
use WebSocketsZMQ\Requests\RequestMessage;
use WebSocketsZMQ\Requests\RequestParams;

class RequestFactory implements RequestFactoryInterface
{
    public function createRequest(): RequestInterface
    {
        return new Request();
    }

    public function createRequestParams(TopicInterface $topic, RequestMessageInterface $requestMessage): RequestParams
    {
        return new RequestParams($topic,$requestMessage);
    }

    public function createRequestMessage(string $msg): RequestMessage
    {
        return new RequestMessage($msg);
    }
}
