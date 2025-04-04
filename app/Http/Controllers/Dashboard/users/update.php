<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$img = $fn->insertImage("users");
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
header("Location: /dashboard/users");