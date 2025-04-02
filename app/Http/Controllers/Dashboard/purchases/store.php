<?php
$db->insert("magical_items", [
    "name" => $_POST['name'],
    "price" => $_POST['price'],
    "type" => $_POST['type'],
]);

header("Location:/dashboard/purchases");