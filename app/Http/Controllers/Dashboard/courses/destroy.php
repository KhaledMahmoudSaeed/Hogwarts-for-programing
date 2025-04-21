<?php
$db->delete("courses", $_POST['id']);
if (!$_POST['img'] == "course.png") {
    $fn->deleteImage("courses", $_POST['img']);
}

header("Location: /dashboard/courses");