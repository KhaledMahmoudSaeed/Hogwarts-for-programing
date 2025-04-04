<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];// get the id from JWT
$courses = $db->getWith2Joins(
    "courses",
    "id",
    "user_id",
    "enrollments",
    "course_id",
    "users",
    "id",
    [
        "enrollments.id" => "id",
        "enrollments.quizz_finish" => "quizz_finish",
        "courses.id" => "cid",
        "courses.name" => "name",
        "courses.img" => "img",
        "users.name" => "professor",
        "users.email" => "email",
    ],
    "enrollments.user_id =$id "
);

$path->view("student/enrolls/index.php", $courses);