<?php
use Helpers\Auth;
if ($_SERVER['REQUEST_URI'] === '/') {
    $_SERVER['REQUEST_URI'] = "home";
}

$user_date = Auth::getAuthenticatedUser();
$path->view("index.php", $user_date);

