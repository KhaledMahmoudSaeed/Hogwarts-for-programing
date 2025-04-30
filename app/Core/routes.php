<?php
// create all our routers 
$router->get('/', 'index.php')->addMiddleware('guest');
$router->get('/home', 'index.php')->addMiddleware('guest');
$router->get('/about', 'index.php')->addMiddleware('guest');
$router->get('/login', 'Authentication/login.view.php')->addMiddleware('guest');
$router->get('/register', 'Authentication/register.view.php')->addMiddleware('guest');
$router->post('/login', 'Authentication/login.php')->addMiddleware('guest');
$router->post('/register', 'Authentication/register.php')->addMiddleware('guest');
$router->post('/logout', 'Authentication/logout.php');
// $router->get('/logout', 'Authentication/logout.php');// for now 
$router->get('/profile', 'Student/profile.php');
$router->get('/owl', 'Student/owls/choose_reciver.php');
$router->post('/chat', 'Student/owls/chat.php');

$router->get('/dashboard', "Dashboard/index.php")->addMiddleware('professor');

/* 
    index   /dashboard/users
    show    /dashboard/user?id=2
    edit    /dashboard/user/edit
    update  /dashboard/user/update
    store   /dashboard/user/store
    delete  /dashboard/user/delete 
*/
$router->resources('/dashboard/users', "Dashboard/users/index.php", 'professor');
$router->resources('/dashboard/courses', "Dashboard/courses/index.php", 'professor');
$router->resources('/dashboard/quizzs', "Dashboard/quizzes/index.php", 'professor');
$router->resources('/dashboard/purchases', "Dashboard/purchases/index.php", 'professor');
$router->get("/quizz", "Student/quizzes/index.php");
$router->post("/quizz", "Student/quizzes/store.php");
$router->resources('/enrolls', "Student/enrolls/index.php");
$router->get("/diagon-alley", "Student/items/index.php");
$router->post("/diagon-alley", "Student/items/store.php");
$router->delete("/diagon-alley", "Student/items/delete.php");
$router->get("/leaderboard", "Student/leaderboard.php");
$router->get('/dashboard/wands', "Dashboard/wands/index.php");
$router->get("/profile/edit", 'Dashboard/users/edit.php');
$router->get("/dashboard/user/promote", 'Dashboard/users/promote.php', 'professor');
$router->post("/dashboard/user/promote", 'Dashboard/users/promote.php', 'professor');
$router->put("/profile", 'Dashboard/users/update.php');

$router->get('/ollivander', "Ollivander.php");
