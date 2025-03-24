<?php
use App\Core\Database;
$db = new Database();
$users = $db->all("users");
foreach ($users as $user) {
    $house_id = $user['house_id'];
    $wand_id = $user['wand_id'];
    $house[] = $db->one("houses", $house_id);
    $wand[] = $db->one("wands", $wand_id);
}
require $path->view_path("dashboard/users/index.php");