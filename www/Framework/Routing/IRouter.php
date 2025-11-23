<?php
namespace Framework\Routing;

interface IRouter
{
    /**
     * Register a route with its HTTP method, pattern, and controller
     */
    public function add(string $method, string $route, string $controllerClass ,string $action): void;

    /**
     * Match the request and return the appropriate controller
     *
     * @throws RouteNotFoundException when no route matches
     */
    public function dispatch(string $method, string $url): string;
}