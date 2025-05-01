<?php
require "../vendor/autoload.php";
use App\Core\Router;
use Helpers\Functions;
use Helpers\Path;
session_start();
$GLOBALS['img'] = new Path;// put an instance of Path class in $GLOBALS to reach it easily
$GLOBALS['function'] = new Functions();// put an instance of Path class in $GLOBALS to reach it easily

$router = new Router();
require_once("../app/Core/routes.php");// use all allowed routes
$router->route($_SERVER['REQUEST_URI'], $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);// grasp uri ,method from current page 