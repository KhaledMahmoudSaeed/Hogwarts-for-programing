<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];// get the id from JWT
$items = $db->where(
    "magical_items",
    "id NOT IN (
    SELECT item_id FROM purchases WHERE user_id =$id)",
    [
        "id" => "id",
        "name" => "name",
        "type" => "type",
        "price" => "price",
        "img" => "img"
    ]
);// get all items which user don't but it yet

$path->view("student/items/index.php", $items);