<?php

namespace GameApi\Src\Http;

use GameApi\Src\Exception\NotFoundException;

class Router
{
    private $request;
    private $routes;

    public function __construct(Request $request, array $routes)
    {
        $this->request = $request;
        $this->routes = $routes;
    }

    public function init()
    {

        if(!$this->request->path()){
            throw new \Exception('PATH Not Found');
        }

        $path = $this->request->path();

        if(array_key_exists($path, $this->routes)){
            $route = $this->routes[$path];

            if(!$route || !isset($route['controller']) || !isset($route['action'])){
                throw new \Exception('ROUTE Not Found');
            }

            if($route['method'] !== $this->request->method()){
                throw new \Exception($this->request->method() . ' Method Not Allowed This Route');
            }

            $controller = '\GameApi\Src\Controller\\' . $route['controller'];
            echo call_user_func_array([$controller, $route['action']], [$this->request]);
            return;
        } else {
            throw new NotFoundException('Url Not Found');
        }
    }
}
