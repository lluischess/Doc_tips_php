<?php

declare(strict_types=1);

namespace App;

class Router
{
    private array $routes = [];

    public function register(string $requestMethod, string $route, callable $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function routes(): array
    {
        return $this->routes;
    }

}