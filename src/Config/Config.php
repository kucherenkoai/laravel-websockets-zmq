<?php

namespace WebSocketsZMQ\Config;

use WebSocketsZMQ\Interfaces\Config\ConfigInterface;

class Config implements ConfigInterface {

    private string $server_host;
    private string $context_push_host;
    private string $context_pull_host;
    private string $broadcast;
    private string $router;
    private bool   $user_all_topics;
    private array  $logs;

    public function __construct(string $server_host = null, string $context_push_host = null, string $context_pull_host = null, string $broadcast = null, string $router = null, bool $user_all_topics = null, array $logs = null)
    {
        $this->server_host       = $server_host       ?? config('zmqPusher.hosts.server_host')       ?? '0.0.0.0:8080';
        $this->context_push_host = $context_push_host ?? config('zmqPusher.hosts.context_push_host') ?? '127.0.0.1:5555';
        $this->context_pull_host = $context_pull_host ?? config('zmqPusher.hosts.context_pull_host') ?? '127.0.0.1:5555';
        $this->broadcast         = $broadcast         ?? config('zmqPusher.broadcast')               ?? 'App\Services\WebSockets\Broadcast\Broadcast';
        $this->router            = $router            ?? config('zmqPusher.router')                  ?? 'App\Services\WebSockets\Router';
        $this->user_all_topics   = $user_all_topics   ?? config('zmqPusher.user_all_topics')         ?? false;
        $this->logs              = $logs              ?? config('zmqPusher.logs')                    ?? $this->getDefaultLogs();
    }

    public function getServerHost(): string
    {
        return $this->server_host;
    }

    public function getContextPushHost(): string
    {
        return $this->context_push_host;
    }

    public function getContextPullHost(): string
    {
        return $this->context_push_host;
    }

    public function getBroadcast(): string
    {
        return $this->context_push_host;
    }

    public function getRouter(): string
    {
        return $this->router;
    }

    public function getUserToAllTopics(): bool
    {
        return $this->user_all_topics;
    }

    public function getLogs(): array
    {
        return $this->logs;
    }

    private function getDefaultLogs(): array
    {
        return [
            'connect'      => ['success' => true, 'error' => true],
            'user'         => ['success' => true, 'error' => true],
            'topic'        => ['success' => true, 'error' => true],
            'message'      => ['success' => true, 'error' => true],
            'request'      => ['success' => true, 'error' => true],
            'response'     => ['success' => true, 'error' => true],
            'notification' => ['success' => true, 'error' => true]
        ];
    }

}
