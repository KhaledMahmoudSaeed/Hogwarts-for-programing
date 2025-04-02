<?php

$db->update("magical_items", [
    "name" => $_POST['name'],
    "type" => $_POST['type'],
    "price" => $_POST['price'],
], $_POST['id']);

header("Location:/dashboard/purchases");