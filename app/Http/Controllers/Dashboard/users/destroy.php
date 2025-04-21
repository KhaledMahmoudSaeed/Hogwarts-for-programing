<?php
$db->delete('users', $_POST['id']);
$users = ["user1.png", "user2.png", "user3.png", "user4.png"];
if (!in_array($_POST['img'], $users)) {
    $fn->deleteImage("users", $_POST['img']);
}
header("Location: /dashboard/users");