<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$data = [
    'name' => $_POST['name'],
];
$fn->validators($data);
if ($_SESSION['errors']) {
    $purchase = [
        "id" => $_POST['id'],
        "name" => $_POST['name'],
        "type" => $_POST['type'],
        "price" => $_POST['price'],
        "img" => $_POST['img'],
    ];
    $path->view("dashboard/purchases/edit.php", $purchase);
    exit;
}
$img = $fn->insertImage("items");
$items = ["wand.png", "potion.png", "broom.png", "book.png"];
if (!in_array($_POST['img'], $items) && !strlen($_FILES['img']['name']) === 0) {
    $fn->deleteImage("items", $_POST['img']);
}
$data = [
    "name" => $_POST['name'],
    "number" => $_POST['price'],
];
if ($img) {
    $db->update("magical_items", [
        "name" => $_POST['name'],
        "type" => $_POST['type'],
        "price" => $_POST['price'],
        "img" => $img
    ], $_POST['id']);
} else {
    $db->update("magical_items", [
        "name" => $_POST['name'],
        "type" => $_POST['type'],
        "price" => $_POST['price'],
    ], $_POST['id']);
}

header("Location:/dashboard/purchases");