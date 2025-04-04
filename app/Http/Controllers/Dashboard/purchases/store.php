<?php
$img = $fn->insertImage("items");
if ($img) {
    $db->insert("magical_items", [
        "name" => $_POST['name'],
        "price" => $_POST['price'],
        "type" => $_POST['type'],
        "img" => $img,
    ]);
} else {
    $db->insert("magical_items", [
        "name" => $_POST['name'],
        "price" => $_POST['price'],
        "type" => $_POST['type']
    ]);
}


header("Location:/dashboard/purchases");