<?php
use Helpers\Auth;
// if there any img uploaded so it will replace the exits one unless you will have the default image

$id = $role = Auth::getAuthenticatedUser()['id'];
$img = $fn->insertImage("users");
$users = ["user1.png", "user2.png", "user3.png", "user4.png"];
if (!in_array($_POST['img'], $users) && !strlen($_FILES['img']['name']) === 0) {
    $fn->deleteImage("users", $_POST['img']);
}
if ($img) {
    $db->update("users", [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'img' => $img,
    ], $_POST['id']);
}
$db->update("users", [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
], $_POST['id']);
if ($_SESSION['role'] === "professor" && $_POST['id'] !== $id) {
    header("Location: /dashboard/users");
} else {
    header("Location: /profile");
}