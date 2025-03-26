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
    //handel all put routes
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, "PUT");
    }
    //handel all delete routes
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
        $path = new Path();
        require $path->base_path("app/Http/requires.php");

        // Extract the base URI (without query parameters) [0]
        $uriWithoutQuery = explode('?', $uri)[0];
        foreach ($this->routers as $router) {
            if ($router['uri'] === $uriWithoutQuery && $router['method'] === $method) {
                return require($path->base_path("app/Http/Controllers/" . $router['controller']));
            }
        }
        $this->abort(404);
    }
    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
    // routes to the 404 or 403,etc pages
    public function abort($code = 404)
    {
        $path = new Path();
        http_response_code($code);
        require $path->view_path("aborts/$code.php");
        die();
    }
}