<?php
$db->delete("magical_items", $_POST['id']);
$fn->deleteImage("items", $_POST['img']);

header("Location: /dashboard/purchases");