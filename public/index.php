<?php
require "../vendor/autoload.php";

use App\Core\Router;

$router = new Router();
require_once("../app/Core/routes.php");// use all allowed routes
$router->route($_SERVER['REQUEST_URI'], $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);// grasp uri ,method from current page 