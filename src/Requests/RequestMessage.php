<?php

namespace WebSocketsZMQ\Requests;

use WebSocketsZMQ\Interfaces\Request\RequestMessageInterface;

class RequestMessage implements RequestMessageInterface {

    private int $code;
    private $topicName;
    private $body;

    public function __construct(string $msg)
    {
        $msg = json_decode($msg,true);

        //Get Params
        $this->code      = $msg[0] ?? null;
        $this->topicName = $msg[1] ?? null;
        $this->body      = $msg[2] ?? null;

    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getTopicName()
    {
        return $this->topicName;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function validateAttachTopic(): bool
    {
        if($this->getCode() === 1  && $this->getTopicName()){
            return true;
        }
        return false;
    }

    public function validateDetachTopic(): bool
    {
        if($this->getCode() === 2 && $this->getTopicName()){
            return true;
        }
        return false;
    }

    public function validateForRoute(): bool
    {
        if($this->getCode() === 3 && $this->getTopicName() && $this->getBody()){
            return true;
        }
        return false;
    }

}
