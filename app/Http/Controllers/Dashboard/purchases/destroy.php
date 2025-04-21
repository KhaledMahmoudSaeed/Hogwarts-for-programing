<?php

$db->delete("magical_items", $_POST['id']);
$items = ["wand.png", "potion.png", "broom.png", "book.png"];
if (!in_array($_POST['img'], $items)) {
   
    $fn->deleteImage("items", $_POST['img']);
}
header("Location: /dashboard/purchases");