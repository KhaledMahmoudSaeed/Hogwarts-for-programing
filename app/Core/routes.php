<?php
// create all our routers 
$id = 1;
$router->get('/', 'index.php');
$router->get('/login', 'Authentication/login.view.php');
$router->get('/register', 'Authentication/register.view.php');
$router->post('/login', 'Authentication/login.php');
$router->post('/register', 'Authentication/register.php');
$router->post('/logout', 'Authentication/logout.php');
$router->get('/logout', 'Authentication/logout.php');// for now 

$router->get('/dashboard', "Dashboard/index.php");

$router->get('/dashboard/users', "Dashboard/users/index.php");
$router->get('/dashboard/user', 'Dashboard/users/show.php');
$router->get('/dashboard/user/edit', 'Dashboard/users/edit.php');
$router->put('/dashboard/users/update', "Dashboard/users/update.php");
$router->delete('/dashboard/users/delete', "Dashboard/users/destroy.php");

$router->get('/dashboard/wands', "Dashboard/wands/index.php");
$router->get('/dashboard/courses', "Dashboard/courses/index.php");
$router->get('/dashboard/purchases', "Dashboard/purchases/index.php");

$router->get('/ollivander', "Ollivander.php");
