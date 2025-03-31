<?php
$db->insert("enrollments", [
    "user_id" => $_POST['user_id'],
    "course_id" => $_POST['course_id'],
]);

header("Location:/enrolls");