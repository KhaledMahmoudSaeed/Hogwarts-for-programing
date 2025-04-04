<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image

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