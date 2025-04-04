<?php
$id = $_GET['id'];
$user = $db->getWith2Joins(
    "users",
    "house_id",
    "wand_id",
    "houses",
    "id",
    "wands",
    "id",
    [
        "users.id" => "id",
        "users.role" => "",
        "users.name" => "uname",
        "users.img" => "img",
        "houses.name" => "hname",
        "users.email" => "",
        "wands.wood" => "wood",
        "wands.core" => "core",
    ],
    "users.id=$id"
);
$path->view("dashboard/users/show.php", $user);
