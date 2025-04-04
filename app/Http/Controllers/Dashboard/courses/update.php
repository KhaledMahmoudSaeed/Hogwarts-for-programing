<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$img = $fn->insertImage("courses");
if ($img) {
    $db->update("courses", [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "img" => $img
    ], $_POST['id']);
} else {
    $db->update("courses", [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
    ], $_POST['id']);
}


header("Location:/dashboard/courses");