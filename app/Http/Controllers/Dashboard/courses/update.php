<?php
// if there any img uploaded so it will replace the exits one unless you will have the default image
$data = [
    "name" => $_POST['name'],
    "string" => $_POST['description'],
];
$fn->validators($data);
if ($_SESSION['errors']) {
    $quizz = [
        "id" => $_POST['id'],
        "img" => $_POST['img'],
        "cname" => $_POST['name'],
        "description" => $_POST['description'],
    ];
    $path->view("dashboard/courses/edit.php", $quizz);
    exit;
}
$img = $fn->insertImage("courses");
if ($_POST['img'] !== "course.png") {
    $fn->deleteImage("courses", $_POST['img']);
}

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