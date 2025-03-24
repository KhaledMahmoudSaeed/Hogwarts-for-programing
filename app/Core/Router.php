<?php

namespace App\Core;
use Helpers\Path;
class Router
{
    private $routers = [];
    private $path = new Path();

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
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, "PUT");
    }
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, "DELETE");
    }

    // public function resources($uri, $controller)
    // {
    // return $this->add($uri, $controller, "GET");
    // return $this->add($uri, $controller, "POST");
    // return $this->add($uri, $controller, "PUT");
    //  return $this->add($uri, $controller, "DELETE");
    // }

    // route the router to correspond controller
    public function route($uri, $method)
    {

        foreach ($this->routers as $router) {

            if ($router['uri'] === $uri && $router['method'] === $method) {
                return require($this->path->base_path("app/Http/Controllers/" . $router['controller']));
            } else {
                $this->abort(404);
            }
        }
    }

    public function abort($code = 404)
    {
        http_response_code($code);
        require $this->path->view_path("aborts/$code.php");
    }
}