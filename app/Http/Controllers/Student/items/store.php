<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];
$user = $db->getOne("users", $id);

if ($user['money'] >= $_POST['price']) {
    $user['money'] -= $_POST['price'];
    $db->update("users", [
        "money" => $user['money'],
    ], $id);
    $db->insert("purchases", [
        "user_id" => $id,
        "item_id" => $_POST['item_id'],
    ]);
} else {
    $_SESSION['money'] = "You don't have enough money poor ";

}

header("Location:/items");
