<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$img = $fn->insertImage("courses");
if ($img) {
    $db->insert("courses", [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "user_id" => $_POST['user_id'],
        "img" => $img
    ]);
} else {
    $db->insert("courses", [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "user_id" => $_POST['user_id'],
    ]);
}
header("Location:/dashboard/courses");