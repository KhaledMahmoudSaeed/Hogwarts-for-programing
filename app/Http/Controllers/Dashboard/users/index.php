<?php
$users = $db->getWith2Joins(
    "users",
    "house_id",
    "wand_id",
    "houses",
    "id",
    "wands",
    "id",
    [
        "users.id" => "",
        "users.role" => "",
        "users.name" => "uname",
        "houses.name" => "hname",
        "users.email" => "",
        "wands.wood" => "wood",
        "wands.core" => "core",
    ]
);

$path->view("dashboard/users/index.php", $users);