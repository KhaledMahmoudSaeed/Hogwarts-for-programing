<?php
require "../vendor/autoload.php";

use App\Core\Router;
use Helpers\Path;
use Helpers\Functions;

$path = new Path();// create an instance for root path
$fn = new Functions();
$router = new Router();
require_once("../app/Core/routes.php");// use all allowed routes

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);// grasp uri ,method from current page 