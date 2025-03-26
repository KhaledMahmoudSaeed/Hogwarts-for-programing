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
        "users.role" => "",
        "users.name" => "uname",
        "houses.name" => "hname",
        "users.email" => "",
        "wands.wood" => "wood",
        "wands.core" => "core",
    ],
    "users.id=$id"
);
require $path->view_path("dashboard/users/show.php");