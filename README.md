## About Laravel WebSocketsZMQ
It's WebSocket package that use ZMQ and Ratchet library.

## Install WebSockets ZMQ with docker

#### php-fpm

````
RUN apt-get update -yqq && \
    apt-get install -y build-essential libtool autoconf pkg-config libsodium-dev libzmq3-dev && \
    curl -L -O  https://github.com/zeromq/php-zmq/archive/master.zip && \
    unzip master.zip && \
    cd php-zmq-master && phpize && ./configure && \
    make && \
    make install
````

#### workspace

````
RUN apt-get update -yqq && \
    apt-get install -y build-essential libtool autoconf pkg-config libsodium-dev libzmq-dev && \
    git clone git://github.com/mkoppanen/php-zmq.git && \
    cd php-zmq && phpize && ./configure && \
    make && \
    make install

RUN apt-get update -yqq && \
    echo "extension=zmq.so" >> /etc/php/${LARADOCK_PHP_VERSION}/cli/php.ini
````

#### Composer

You need run composer terminal command:
```
composer require kucherenkoai/laravel-websockets-zmq
```

#### config/app.php

In this config file we need add new WebSockets Provider form library.

````
'providers' => [
    ...
    ...
    ...
    WebSocketsZMQ\Providers\WebSocketsZMQProvider::class <-- new row in providers side 
];
````

#### Composer publish config

```
php artisan vendor:publish --provider="WebSocketsZMQ\Providers\WebSocketsZMQProvider"
```

After publish you will have new config file `/config/zmqPusher.php` where you will change WebSockets params.
This file looks like: 

```
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
```

And you will have new command that will start WebSockets server after all configurations.
This command looks like:
```
php artisan command:webSocketServer   
```

#### config/logging.php
In chanel side of this file need add ne chanel of logs for WebSockets.


````
'channels' => [
    ...
    ...
    ...
    'webSocketsZMQ' => [
        'driver' => 'single',
        'path'   => storage_path('logs/web_sockets_zmq.log'),
        'level'  => 'debug',
    ],

];
````
                  
## Usage 

### Backend:
For work with library need create 3 files:
1. `Broadcast` file.
2. `Route` file.
3. `Custom Controller(s)` file(s).


#### Broadcast file has 3 methods:

1. `connect` method in which new users are allowed or denied to log in.
2. `subscribe` method in which it is allowed or forbidden for the already auth user to connect to a specific topic.
3. `topics` method in which to return what topics can exist in the system for listening.

EXAMPLE:

````
<?php
namespace App\Services\WebSockets\Broadcast;

use App\Models\User;
use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Entities\Broadcast as BaseBroadcast;

class Broadcast extends BaseBroadcast implements BroadcastInterface {

    protected function connect(array $connectionParams)
    {
        if(!$user = User::find($connectionParams['token'])){
            return null;
        }
        return $user->id;
    }

    protected function subscribe($topic, UserInterface $user): bool
    {
        if($topic == 'notifications' && $user->getId() == $user->getId()){
            return true;
        }
        return false;
    }

    public function topics(): array
    {
        return ['notifications'];
    }
}
````

#### Router file has 2 methods:


1.method in which they check which user sends the message to which route
2. We finish the routes that we will use


1. `auth` method that check which user sends the message to which route. And return bool true if user have access or false if doesnt have.
2. `routes` add routes (params when we add new route: name of route, custom controller file, method of controller what we will use).

EXAMPLE:

````
<?php

namespace App\Services\WebSockets;

use App\Http\Requests\User\UserCreateRequest;
use App\Services\WebSockets\Controllers\Notification;
use WebSocketsZMQ\Interfaces\Entities\RouterInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Route\Router as BaseRouter;

class Router extends BaseRouter implements RouterInterface {

    public function auth($topic, UserInterface $user): bool
    {
        if($topic == 'notifications' && $user->getId() == $user->getId()){
            return true;
        }
        return false;
    }

    /**
     * If we can use request api validation we can add 4 param.
     *  $this->addRouter('notifications',Notification::class,'get',UserCreateRequest::class);
     */
    public function routes(): void
    {
        $this->addRouter('notifications',Notification::class,'get');
    }
}
````

#### Custom controller:

EXAMPLE:
````
<?php

namespace App\Services\WebSockets\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use WebSocketsZMQ\Interfaces\Request\RequestInterface;
use WebSocketsZMQ\Response;

class NotificationController {

    public function get(RequestInterface $request)
    {
        $users[]   = $request->getUser()->getId();
        $body      = $request->getBody();
        $topicName = $request->getTopic();

        $user = User::find($request->getUser()->getId());
        $userResource = new UserResource($user);

        $response = new Response();
        $response->addTopicName('notifications')->addUsers($users)->addData($userResource)->send();
    }

}
````

#### Comment:
Response file can use not only custom controller and in different places in your application.
 
## License

The LaravelWebSocketsZmq is open-sourced software licensed under the [license](LICENSE).
