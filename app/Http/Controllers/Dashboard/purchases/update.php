<?php
$img = $fn->insertImage("items");
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
        "img" => $img
    ], $_POST['id']);
}

header("Location:/dashboard/purchases");