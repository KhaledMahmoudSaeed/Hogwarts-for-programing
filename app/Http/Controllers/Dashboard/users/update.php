<?php
use Helpers\Auth;
$data = [
    'name' => $_POST['name'] ?? '',
    'email' => $_POST['email'] ?? '',
];

$errors = $fn->validators($data);

if ($_SESSION['errors']) {
    $user = [
        'email' => $_POST['email'],
        'img' => $_POST['img'],
        'name' => $_POST['name'],
    ];
    $path->view("dashboard/users/edit.php", $user);
    exit;
}

// if there any img uploaded so it will replace the exits one unless you will have the default image
$id = Auth::getAuthenticatedUser()['id'];
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

if ($_SESSION['role'] !== "student" && (string)$_POST['id'] !== (string)$id) {
    header("Location: /dashboard/users");
} else {
    header("Location: /profile");
}