<?php

namespace Core;
use Core\Middleware\Authenticated;

class Router
{

    protected $routes = [];

    public function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => $method,
            'middleware' => null,
        ];

        // $this -> routes[] = compact('method', 'uri', 'controller');

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }

    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }

    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }

    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                if ($route['middleware']) Authenticated::resolve($route['middleware']);                

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }

    public function only($key)
    {
        $this->routes[array_key_last($this -> routes)]['middleware'] = $key;

        return $this;
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
