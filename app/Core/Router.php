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

    public function resources($uri, $controller)
    {
        //index   /dashboard/users  
        $this->get($uri, $controller);

        //show    /dashboard/user?id=2
        $uri = substr($uri, 0, -1);
        $controller = substr_replace($controller, "show.php", -9);
        $this->get($uri, $controller);

        //edit    /dashboard/user/edit
        $uri .= "/edit";
        $controller = substr_replace($controller, "edit.php", -8);
        $this->get($uri, $controller);

        //update  /dashboard/user/update
        $uri = substr_replace($uri, "update", -4);
        $controller = substr_replace($controller, "update.php", -8);
        $this->put($uri, $controller);

        //create   /dashboard/user/create
        $uri = substr_replace($uri, "create", -6);
        $controller = substr_replace($controller, "create.php", -10);
        $this->get($uri, $controller);

        //store   /dashboard/user/store
        $uri = substr_replace($uri, "store", -6);
        $controller = substr_replace($controller, "store.php", -10);
        $this->post($uri, $controller);

        //delete  /dashboard/user/delete 
        $uri = substr_replace($uri, "delete", -5);
        $controller = substr_replace($controller, "destroy.php", -9);
        $this->delete($uri, $controller);
    }

    // route the router to correspond controller
    public function route($uri, $method)
    {
        // echo "<pre>";
        // var_dump($this->routers);
        // echo "</pre>";
        // exit;
        $path = new Path();
        require $path->base_path("app/Http/requires.php");
        $uri = rtrim($uri, "/");
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