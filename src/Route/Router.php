<?php

namespace WebSocketsZMQ\Route;

use WebSocketsZMQ\Factories\RouteFactory;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Interfaces\Request\RequestInterface;
use WebSocketsZMQ\Interfaces\Collections\RouteCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\RouterInterface;
use WebSocketsZMQ\Logs\PusherLogs;

abstract class Router implements RouterInterface {

    private RouteFactory $routeFactory;
    private RouteCollectionInterface $collection;
    private PusherLogs $logs;

    public function __construct()
    {
        $this->routeFactory = new RouteFactory();
        $this->collection = $this->routeFactory->createRouteCollection();
        $this->logs = new PusherLogs();

    }

    public function make(RequestInterface $request)
    {
        //Check auth
        if(!$this->authValidate($request->getTopic(),$request->getUser())){
            $this->logs->request('Request route auth fail',$request, false);
            return false;
        }

        //Add client roues
        $this->routes();

        //Fetch client routes
        $routes = $this->collection->getAll();

        $topicName = $request->getTopic()->getName();

        if(!isset($routes[$topicName])){
            $this->logs->request('Route not found',$request, true);
            return false;
        }

        try {
            $this->logs->request('Request route auth true.', $request, true);
        }catch (\Exception $exception){
            var_dump($exception->getMessage());
        }
        return $routes[$topicName]->make($request);
    }

    public function addRouter($topic, $class, $method, $validate = null): void
    {
        $route = $this->routeFactory->createRoute($topic, $class, $method, $validate);
        $this->collection->attach($route);
    }

    public function authValidate(TopicInterface $topic, UserInterface $user): bool
    {
        return $this->auth($topic->getName(),$user);
    }

    abstract function auth($topic, UserInterface $user): bool;

    abstract function routes(): void;

}


