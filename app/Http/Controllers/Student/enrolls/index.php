<?php
use Helpers\Auth;
session_start();
$id = Auth::getAuthenticatedUser()['id'];
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
        "users.name" => "professor",
        "users.email" => "email",
    ],
    "enrollments.user_id =$id "
);
    
$path->view("student/enrolls/index.php", $courses);