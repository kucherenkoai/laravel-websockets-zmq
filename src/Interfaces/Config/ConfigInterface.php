<?php

namespace WebSocketsZMQ\Interfaces\Config;

interface ConfigInterface
{
    public function getServerHost(): string;

    public function getContextPushHost(): string;

    public function getContextPullHost(): string;

    public function getBroadcast(): string;

    public function getRouter(): string;

    public function getUserToAllTopics(): bool;

    public function getLogs(): array;
}
