<?php

return [
    'hosts' => [
        'server_host'       => '0.0.0.0:8080',
        'context_push_host' => '127.0.0.1:5555',
        'context_pull_host' => '127.0.0.1:5555',
    ],

    'logs' => [
        'connect'      => ['success' => true, 'error' => true],
        'user'         => ['success' => true, 'error' => true],
        'topic'        => ['success' => true, 'error' => true],
        'message'      => ['success' => true, 'error' => true],
        'request'      => ['success' => true, 'error' => true],
        'response'     => ['success' => true, 'error' => true],
        'notification' => ['success' => true, 'error' => true]
    ],

    'broadcast'       => 'App\Services\WebSockets\Broadcast\Broadcast',
    'router'          => 'App\Services\WebSockets\Router',
    'user_all_topics' => true,
];
