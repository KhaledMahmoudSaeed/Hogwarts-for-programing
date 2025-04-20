<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];// get the id from JWT
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

// Get the user's purchases
$allPurchases = $db->getWithJoin(
    "purchases",
    "item_id",
    "magical_items",
    "id",
    [
        "purchases.user_id" => "user_id",
        "magical_items.name" => "item_name",
        "magical_items.type" => "item_type",
        "magical_items.img" => "item_img",
        "magical_items.price" => "item_price",
        "purchases.created_at" => "purchased_at",
    ]
);

// Filter out only this user’s purchases
$userPurchases = array_filter(
    $allPurchases,
    fn($row) => $row['user_id'] == $id
);

// Attach to the user data
$users[0]['purchases'] = $userPurchases;

$path->view("student/profile.php", $users);
