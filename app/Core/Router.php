<?php

namespace App\Core;
use Helpers\Path;
class Router
{
    private $routers = [];

    // method to make it easy add routes with no redendancy
    public function add($uri, $controller, $method)
    {
        $this->routers[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method
        ];
        return $this;
    }
    //handel all get routes
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, "GET");
    }
    //handel all post routes

    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, "POST");

    }

    // route the router to correspond controller
    public function route($uri, $method)
    {
        $path = new Path();
        foreach ($this->routers as $router) {

            if ($router['uri'] === $uri && $router['method'] === $method) {
                return require($path->base_path("app/Http/Controllers/" . $router['controller']));
            }
        }
    }
}