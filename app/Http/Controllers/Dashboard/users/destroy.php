<?php
$user = $db->getOne("users", $_POST['id']);
$db->delete('users', $_POST['id']);
$users = ["user1.png", "user2.png", "user3.png", "user4.png"];
if (!in_array($user['img'], $users)) {
    $fn->deleteImage("users", $user['img']);
}
header("Location: /dashboard/users");