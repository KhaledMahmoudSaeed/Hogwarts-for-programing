<?php

namespace App\Core;

use App\Core\Middleware\Middleware;
use Helpers\Path;
class Router
{
    private $routers = [];

    // method to make it easy add routes with no redendancy
    public function add($uri, $controller, $method, $middleware = 'auth')
    {
        $this->routers[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            'middleware' => $middleware
        ];
        return $this;
    }
    // to add middleware automatically to $this->routes
    public function addMiddleware($middleware)
    {
        $this->routers[array_key_last($this->routers)]['middleware'] = $middleware;
    }
    //handel all get routes
    public function get($uri, $controller, $middleware = 'auth')
    {
        return $this->add($uri, $controller, "GET", $middleware);
    }
    //handel all post routes
    public function post($uri, $controller, $middleware = 'auth')
    {
        return $this->add($uri, $controller, "POST", $middleware);
    }
    //handel all put routes
    public function put($uri, $controller, $middleware = 'auth')
    {
        return $this->add($uri, $controller, "PUT", $middleware);
    }
    //handel all delete routes
    public function delete($uri, $controller, $middleware = 'auth')
    {
        return $this->add($uri, $controller, "DELETE", $middleware);
    }
    // handel all METHODs above
    public function resources($uri, $controller, $middleware = 'auth')
    {
        //index   /dashboard/users  
        $this->get($uri, $controller, $middleware);

        //show    /dashboard/user?id=2
        $uri = substr($uri, 0, -1);
        $controller = substr_replace($controller, "show.php", -9);
        $this->get($uri, $controller, $middleware);

        //edit    /dashboard/user/edit
        $uri .= "/edit";
        $controller = substr_replace($controller, "edit.php", -8);
        $this->get($uri, $controller, $middleware);

        //update  /dashboard/user/update
        $uri = substr_replace($uri, "update", -4);
        $controller = substr_replace($controller, "update.php", -8);
        $this->put($uri, $controller, $middleware);

        //create   /dashboard/user/create
        $uri = substr_replace($uri, "create", -6);
        $controller = substr_replace($controller, "create.php", -10);
        $this->get($uri, $controller, $middleware);

        //store   /dashboard/user/store
        $uri = substr_replace($uri, "store", -6);
        $controller = substr_replace($controller, "store.php", -10);
        $this->post($uri, $controller, $middleware);

        //delete  /dashboard/user/delete 
        $uri = substr_replace($uri, "delete", -5);
        $controller = substr_replace($controller, "destroy.php", -9);
        $this->delete($uri, $controller, $middleware);
    }

    // route the router to correspond controller
    public function route($uri, $method)
    {
        // echo "<pre>";
        // var_dump($uri, $method);
        // echo "</pre>";
        // exit;
        $path = new Path();
        require $path->base_path("app/Http/requires.php");
        if (!$uri === "/") {
            $uri = rtrim($uri, "/");
        }
        // Extract the base URI (without query parameters) [0]
        $uriWithoutQuery = explode('?', $uri)[0];
        foreach ($this->routers as $router) {
            if ($router['uri'] === $uriWithoutQuery && $router['method'] === $method) {
                // check the Authorization by calling resolve that redirect to middleware map
                $message = (new Middleware)->resolve($router['middleware'], $uriWithoutQuery);
                if ($message === "200") {// if you are authorized
                    $controllerPath = $path->base_path("app/Http/Controllers/" . $router['controller']);
                    // to handel if route is exits and controller not exits when using resource method
                    try {
                        if (!file_exists($controllerPath)) {// check if controller found or not
                            $this->abort();
                        }

                        return require $controllerPath;
                    } catch (\Throwable $th) {// if you are not authorized
                        throw $th;
                        $this->abort();
                    }
                } else {
                    $this->abort($message);
                }
            }
        }
        $this->abort(404);
    }
    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
    // routes to the 404 or 403,etc pages
    public static function abort($code = 404)
    {
        $path = new Path();
        http_response_code($code);
        require $path->view_path("aborts/$code.php");
        die();
    }
}