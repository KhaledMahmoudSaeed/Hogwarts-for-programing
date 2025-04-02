<?php
$items = $db->getAll(
    "magical_items",
);

$path->view("dashboard/purchases/index.php", $items);