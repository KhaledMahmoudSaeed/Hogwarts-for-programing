<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$data = [
    "name" => $_POST['name'],
    "number" => $_POST['price'],
];
$fn->validators($data);
if ($_SESSION['errors']) {
    header("Location:/dashboard/purchase/create");
    exit;
}
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
        "type" => $_POST['type'],
        "img" => strtolower($_POST['type'] . ".png")
    ]);
}


header("Location:/dashboard/purchases");