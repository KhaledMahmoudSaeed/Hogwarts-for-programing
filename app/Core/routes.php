<?php
// create all our routers 

$router->get('/', 'index.php');
$router->get('/login', 'Authentication/login.view.php');
$router->get('/register', 'Authentication/register.view.php');
$router->post('/login', 'Authentication/login.php');
$router->post('/register', 'Authentication/register.php');
$router->post('/logout', 'Authentication/logout.php');
$router->get('/logout', 'Authentication/logout.php');// for now 

$router->get('/dashboard', "Dashboard/index.php");
$router->get('/dashboard/users', "Dashboard/users/index.php");
$router->get('/dashboard/wands', "Dashboard/wands/index.php");
$router->get('/dashboard/courses', "Dashboard/courses/index.php");
$router->get('/dashboard/purchases', "Dashboard/purchases/index.php");

