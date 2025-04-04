<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];
$users = $db->getWith2Joins(
    "users",
    "house_id",
    "wand_id",
    "houses",
    "id",
    "wands",
    "id",
    [
        "users.name" => "uname",
        "users.img" => "img",
        "users.money" => "money",
        "houses.name" => "hname",
        "users.email" => "",
        "wands.wood" => "wood",
        "wands.core" => "core",
    ],
    "users.id=$id"
);

$path->view("student/profile.php", $users);
