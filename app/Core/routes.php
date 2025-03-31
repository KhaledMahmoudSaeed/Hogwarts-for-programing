<?php
// create all our routers 
$router->get('/', 'index.php');
$router->get('/home', 'index.php');
$router->get('/about', 'index.php');
$router->get('/login', 'Authentication/login.view.php');
$router->get('/register', 'Authentication/register.view.php');
$router->post('/login', 'Authentication/login.php');
$router->post('/register', 'Authentication/register.php');
$router->post('/logout', 'Authentication/logout.php');
$router->get('/logout', 'Authentication/logout.php');// for now 

$router->get('/dashboard', "Dashboard/index.php");

/* 
    index   /dashboard/users
    show    /dashboard/user?id=2
    edit    /dashboard/user/edit
    update  /dashboard/user/update
    store   /dashboard/user/store
    delete  /dashboard/user/delete 
*/
$router->resources('/dashboard/users', "Dashboard/users/index.php");
$router->resources('/dashboard/courses', "Dashboard/courses/index.php");
$router->resources('/enrolls', "Student/enrolls/index.php");
$router->resources('/dashboard/purchases', "Dashboard/purchases/index.php");

$router->get('/dashboard/wands', "Dashboard/wands/index.php");

$router->get('/ollivander', "Ollivander.php");
