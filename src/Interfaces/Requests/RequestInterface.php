<?php

namespace WebSocketsZMQ\Interfaces\Request;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;

interface RequestInterface
{
    public function getTopic(): TopicInterface;

    public function getUser(): UserInterface;

    public function getMessage(): RequestMessageInterface;

    public function addTopic(TopicInterface $topic): TopicInterface;

    public function addUser(UserInterface $user): UserInterface;

    public function addMessage(RequestMessageInterface $requestMessage): RequestMessageInterface;

    public function getBody();

    public function validateRequest(): bool;

    public function validateForRoute(): bool;

    public function validateAttachTopic(): bool;

    public function validateDetachTopic(): bool;


}
