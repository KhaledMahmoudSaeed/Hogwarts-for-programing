<?php
use Helpers\Auth;
session_start();
$id = Auth::getAuthenticatedUser()['id'];
$items = $db->where(
    "magical_items",
    "id NOT IN (
    SELECT item_id FROM purchases WHERE user_id =$id)",
    [
        "id" => "id",
        "name" => "name",
        "type" => "type",
        "price" => "price"
    ]
);

$path->view("student/items/index.php", $items);