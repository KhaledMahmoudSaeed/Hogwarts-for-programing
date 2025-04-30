<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$data = [
    "name" => $_POST['name'],
    "string" => $_POST['description'],
];
$fn->validators($data);
if ($_SESSION['errors']) {
    header("Location:/dashboard/course/create");
    exit;
}
if (strlen($_FILES['img']['name']) !== 0) {
    $img = $fn->insertImage("courses");
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