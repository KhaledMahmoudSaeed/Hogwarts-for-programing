<?php
use Helpers\Auth;
// to get the $content in view from /home
if ($_SERVER['REQUEST_URI'] === '/') {
    $_SERVER['REQUEST_URI'] = "/home";
}

$user_date = Auth::getAuthenticatedUser() ?? ['null' => null];// get all user data from JWT token

$path->view("index.php", $user_date);

