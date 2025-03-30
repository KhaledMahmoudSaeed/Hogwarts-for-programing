<?php
$courses = $db->getWithJoin(
    "users",
    "id",
    "courses",
    "user_id",
    [
        "courses.id" => "id",
        "users.name" => "pname",
        "courses.name" => "cname",
        "courses.description" => "description"
    ]
);

$path->view("dashboard/courses/index.php", $courses);